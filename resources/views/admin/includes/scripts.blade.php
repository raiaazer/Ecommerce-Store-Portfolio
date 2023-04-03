<script>var hostUrl = "assets/index.html";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->

<script src="{{ asset('admin_assets/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('admin_assets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

{{-- <script src="../../../assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script> --}}
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
{{-- <script src="{{ asset('admin_assets/assets/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script> --}}

<script src="{{ asset('admin_assets/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/custom/intro.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/custom/utilities/modals/users-search.js') }}"></script>

<script src="{{ asset('admin_assets/assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus p-2 my-2 bg-danger text-light"></i></a><input type="text" name="variation[]" class="form-control p-2" value=""/></div>';
        var x = 1;

        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });

        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });
</script>
<script>

    const lightThemeLinks = [
      document.querySelector('#light-theme'),
      document.querySelector('#light-theme-datatable'),
      document.querySelector('#light-theme-global'),
      document.querySelector('#light-theme-style')
    ];
    const darkThemeLinks = [
      document.querySelector('#dark-theme'),
      document.querySelector('#dark-theme-datatable'),
      document.querySelector('#dark-theme-global'),
      document.querySelector('#dark-theme-style')
    ];

    function setTheme() {
      const body = document.querySelector('body');
      const currentTheme = localStorage.getItem('theme');
      if (currentTheme === 'dark') {
        body.classList.add('dark-mode');
        lightThemeLinks.forEach(link => link.disabled = true);
        darkThemeLinks.forEach(link => link.disabled = false);
      } else {
        body.classList.remove('dark-mode');
        lightThemeLinks.forEach(link => link.disabled = false);
        darkThemeLinks.forEach(link => link.disabled = true);
      }
    }

    function toggleTheme() {
      const body = document.querySelector('body');
      const isDark = body.classList.contains('dark-mode');
      body.classList.toggle('dark-mode');
      const sunIcon = document.querySelector('.fonticon-sun');
      const moonIcon = document.querySelector('.fonticon-moon');
      if (isDark) {
        localStorage.setItem('theme', 'light');
        lightThemeLinks.forEach(link => link.disabled = false);
        darkThemeLinks.forEach(link => link.disabled = true);
        sunIcon.classList.remove('d-none');
        moonIcon.classList.add('d-none');
      } else {
        localStorage.setItem('theme', 'dark');
        lightThemeLinks.forEach(link => link.disabled = true);
        darkThemeLinks.forEach(link => link.disabled = false);
        sunIcon.classList.add('d-none');
        moonIcon.classList.remove('d-none');
      }
    }

    window.onload = setTheme;
</script>


@yield('script')
