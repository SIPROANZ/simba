<div class="preloader flex-column justify-content-center align-items-center">

    {{-- Preloader logo --}}
    <img src="{{ asset(config('adminlte.preloader.img.path', 'vendor/adminlte/dist/img/AdminLTELogo1.png')) }}"
         class="{{ config('adminlte.preloader.img.effect', 'animation__shake') }}"
         alt="{{ config('adminlte.preloader.img.alt', 'AdminLTE Preloader Image') }}"
         width="{{ config('adminlte.preloader.img.width', 90) }}"
         height="{{ config('adminlte.preloader.img.height', 90) }}">

</div>
