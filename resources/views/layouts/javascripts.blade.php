

<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('admintable/js') }}/bootstrap.min.js"></script>
<script src="{{ url('admintable/js') }}/main.js"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>

@yield('javascript')