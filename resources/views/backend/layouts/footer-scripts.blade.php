 
<script>
    var plugin_path = '{{ asset('backend/assets/js/') }}';
</script>
<script src="{{ asset('backend/assets/js/datepicker.js') }}" defer></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

<script>
    const userID = "{{ auth('admin')->id() }}";
    console.log(userID);
</script>

 

{{-- @include('sweetalert::alert') --}}

<script>
    @if (session('toast_success'))
        toastr.success("{{ session('toast_success') }}", "", {
            "timeOut": 1000
        }); // Set timeOut to 1000 milliseconds (1 second)
    @endif
</script>

 
@if (request()->routeIs('admin.brands.index') ||
        request()->routeIs('admin.categories.index') ||
        request()->routeIs('admin.stores.index') ||
        request()->routeIs('admin.vendors.index') ||
        request()->routeIs('admin.products.index') ||
        request()->routeIs('admin.product_variants.index') ||
        request()->routeIs('admin.orders.index') ||
        request()->routeIs('admin.deliveries.index') ||
        request()->routeIs('admin.product_properties.index') ||
        request()->routeIs('admin.attributes.index') ||
        request()->routeIs('admin.attribute_values.index') ||
        request()->routeIs('admin.coupons.index') ||
        request()->routeIs('admin.roles.index') ||
        request()->routeIs('admin.admins.index') ||
        request()->routeIs('admin.reports.orders') ||
        request()->routeIs('admin.websiteParts.index') ||
        request()->routeIs('admin.banners.index') ||
        request()->routeIs('admin.paymentGateways.index') ||
        request()->routeIs('admin.blogNews.index') ||
        request()->routeIs('admin.blogNews.create') ||
        request()->routeIs('admin.blogNews.edit') ||
        request()->routeIs('delivery.orders.index') ||
        request()->routeIs('delivery.orders.reports') ||
        request()->routeIs('delivery.deliveredOrders.reports') ||
        request()->routeIs('vendor.products.index') ||
        request()->routeIs('vendor.orders.index') ||
        request()->routeIs('vendor.attributes.index') ||
        request()->routeIs('vendor.attribute_values.index') ||
        request()->routeIs('vendor.product_variants.index') ||
        request()->routeIs('vendor.product_variants.create') ||
        request()->routeIs('vendor.coupons.index') ||
        request()->routeIs('vendor.notifications.index'))
    <script src="{{ asset('backend/assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/buttons.flash.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/pdfmake.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/vfs_fonts.js') }}" defer></script>
    <script src="{{ asset('backend/assets/datatables/export-tables/buttons.print.min.js') }}" defer></script>
@endif

 



@stack('scripts')
