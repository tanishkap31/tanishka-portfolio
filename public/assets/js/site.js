/* Public portfolio scripts: theme switch, mobile menu, scroll effects, copy buttons */
(function () {
  'use strict';

  var doc = document.documentElement;

  /* ----- Theme switch (saved in this browser only) ----- */
  var themeBtn = document.getElementById('themeBtn');

  function currentTheme() {
    var t = doc.getAttribute('data-theme');
    if (t) return t;
    return window.matchMedia && matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  if (themeBtn) {
    themeBtn.addEventListener('click', function () {
      var next = currentTheme() === 'dark' ? 'light' : 'dark';
      doc.setAttribute('data-theme', next);
      doc.setAttribute('data-bs-theme', next);
      try { localStorage.setItem('pf-theme', next); } catch (e) { /* storage blocked: still works */ }
    });
  }

  /* ----- Mobile menu ----- */
  var header = document.querySelector('.site-header');
  var menuBtn = document.getElementById('menuBtn');

  function setMenu(open) {
    if (!header || !menuBtn) return;
    header.classList.toggle('nav-open', open);
    menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    menuBtn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  }

  if (menuBtn) {
    menuBtn.addEventListener('click', function () {
      setMenu(!header.classList.contains('nav-open'));
    });
    document.querySelectorAll('.nav-links a').forEach(function (a) {
      a.addEventListener('click', function () { setMenu(false); });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') setMenu(false);
    });
  }

  /* ----- Scroll progress bar ----- */
  var bar = document.getElementById('progress');
  if (bar) {
    var ticking = false;
    var update = function () {
      var max = doc.scrollHeight - window.innerHeight;
      bar.style.transform = 'scaleX(' + (max > 0 ? Math.min(1, window.scrollY / max) : 0) + ')';
      ticking = false;
    };
    window.addEventListener('scroll', function () {
      if (!ticking) { ticking = true; requestAnimationFrame(update); }
    }, { passive: true });
    update();
  }

  /* ----- Fade sections in when they scroll into view ----- */
  var reveals = document.querySelectorAll('.reveal');
  var showAll = function () { reveals.forEach(function (el) { el.classList.add('in'); }); };

  if ('IntersectionObserver' in window && reveals.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          io.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
    reveals.forEach(function (el) { io.observe(el); });
    setTimeout(showAll, 5000); // safety net: never leave content hidden
  } else {
    showAll();
  }

  /* ----- Highlight the menu link of the section you are reading ----- */
  var links = Array.prototype.slice.call(document.querySelectorAll('.nav-links a[data-section]'));
  if ('IntersectionObserver' in window && links.length) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        links.forEach(function (a) {
          a.classList.toggle('active', a.getAttribute('data-section') === entry.target.id);
        });
      });
    }, { rootMargin: '-40% 0px -55% 0px' });
    links.forEach(function (a) {
      var section = document.getElementById(a.getAttribute('data-section'));
      if (section) spy.observe(section);
    });
  }

  /* ----- Copy buttons ----- */
  document.querySelectorAll('[data-copy]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var text = btn.getAttribute('data-copy');
      var label = btn.getAttribute('data-label') || 'Copy';
      var done = function (msg) {
        btn.textContent = msg;
        setTimeout(function () { btn.textContent = label; }, 1500);
      };
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function () { done('Copied'); }, function () { done('Press Ctrl+C'); });
      } else {
        done('Press Ctrl+C');
      }
    });
  });

  /* ----- Contact form: scroll to it after sending, stop double clicks ----- */
  var notice = document.querySelector('[data-scroll-contact]');
  if (notice) {
    var target = document.getElementById('contact');
    if (target) target.scrollIntoView();
  }

  var form = document.getElementById('contactForm');
  if (form) {
    form.addEventListener('submit', function () {
      var submit = form.querySelector('button[type="submit"]');
      if (submit) {
        submit.disabled = true;
        submit.textContent = 'Sending...';
      }
    });
  }
})();
