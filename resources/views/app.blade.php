<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="csrf-token" value="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="/assets/img/logo/svg/logo-black.svg">
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
</head>

<body>
  <div id="app">
    <app></app>
  </div>

  <script src="{{ mix('js/app.js') }}"></script>
  <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/js/startup-modern.js"></script>

  <script>
    (function() {

      // JavaScript snippet handling Dark/Light mode switching

      const getStoredTheme = () => localStorage.getItem('theme');
      const setStoredTheme = theme => localStorage.setItem('theme', theme);
      const forcedTheme = document.documentElement.getAttribute('data-bss-forced-theme');

      const getPreferredTheme = () => {

        if (forcedTheme) return forcedTheme;

        const storedTheme = getStoredTheme();
        if (storedTheme) {
          return storedTheme;
        }

        const pageTheme = document.documentElement.getAttribute('data-bs-theme');

        if (pageTheme) {
          return pageTheme;
        }

        return 'light';
      }

      const setTheme = theme => {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.setAttribute('data-bs-theme', 'dark');
        } else {
          document.documentElement.setAttribute('data-bs-theme', theme);
        }
      }

      setTheme(getPreferredTheme());

      const showActiveTheme = (theme, focus = false) => {
        const themeSwitchers = [].slice.call(document.querySelectorAll('.theme-switcher'));

        if (!themeSwitchers.length) return;

        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
          element.classList.remove('active');
          element.setAttribute('aria-pressed', 'false');
        });

        for (const themeSwitcher of themeSwitchers) {

          const btnToActivate = themeSwitcher.querySelector('[data-bs-theme-value="' + theme + '"]');

          if (btnToActivate) {
            btnToActivate.classList.add('active');
            btnToActivate.setAttribute('aria-pressed', 'true');
          }
        }
      }

      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme();
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
          setTheme(getPreferredTheme());
        }
      });

      window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme());

        document.querySelectorAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', (e) => {
              e.preventDefault();
              const theme = toggle.getAttribute('data-bs-theme-value');
              setStoredTheme(theme);
              setTheme(theme);
              showActiveTheme(theme);
            })
          })
      });
    })();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
</body>

</html>