(function () {
  var KEY = "adminlteDarkMode";
  var saved = localStorage.getItem(KEY);
  var prefers = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
  var initialDark = saved === "true" || (saved === null && prefers);
  if (initialDark) document.body.classList.add("dark-mode");

  function updateIcon(el, isDark) {
    if (!el) return;
    var i = el.querySelector("i");
    if (!i) return;
    i.classList.toggle("fa-sun", isDark);
    i.classList.toggle("fa-moon", !isDark);
  }
  function setDark(on) {
    document.body.classList.toggle("dark-mode", on);
    localStorage.setItem(KEY, on ? "true" : "false");
  }

  function init() {
    var toggle = document.getElementById("dark-mode-toggle");
    var switchEl = document.getElementById("darkModeSwitch");
    var switchLabel = document.querySelector('label[for="darkModeSwitch"]');
    var isDark = document.body.classList.contains("dark-mode");

    updateIcon(toggle, isDark);
    updateIcon(switchLabel, isDark);
    if (switchEl) switchEl.checked = isDark;

    if (toggle) {
      toggle.addEventListener("click", function (e) {
        e.preventDefault();
        var now = !document.body.classList.contains("dark-mode");
        setDark(now);
        updateIcon(toggle, now);
        updateIcon(switchLabel, now);
        if (switchEl) switchEl.checked = now;
      });
    }
    if (switchEl) {
      switchEl.addEventListener("change", function () {
        var now = !!switchEl.checked;
        setDark(now);
        updateIcon(toggle, now);
        updateIcon(switchLabel, now);
      });
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
