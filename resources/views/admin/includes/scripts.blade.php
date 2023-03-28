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
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus p-2 my-2 bg-danger text-light"></i></a><input type="text" name="variation[]" class="form-control p-2" value=""/></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
@yield('script')
