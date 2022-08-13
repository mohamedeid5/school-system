<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = '{{ asset('assets/js') }}/';

</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
@toastr_js
@toastr_render

<script>
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            let grade_id = $(this).val();
            if(grade_id) {

                $.ajax({
                    url: "{{ url('classes') }}/" + grade_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data){
                        $('select[name="classroom_id"]').empty();
                        $('select[name="classroom_id"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');

                        $.each(data, function (key, value){
                            $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                })
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('select[name="classroom_id"]').on('change', function () {
            let classroom_id = $(this).val();
            if(classroom_id) {

                $.ajax({
                    url: "{{ url('get-sections')  }}/" + classroom_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data){
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                })
            }
        });
    });
</script>





<script>
    $(document).ready(function () {
        $('select[name="grade_id_new"]').on('change', function () {
            let grade_id = $(this).val();
            if(grade_id) {

                $.ajax({
                    url: "{{ url('classes') }}/" + grade_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data){
                        $('select[name="classroom_id_new"]').empty();
                        $('select[name="classroom_id_new"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');

                        $.each(data, function (key, value){
                            $('select[name="classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                })
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('select[name="classroom_id_new"]').on('change', function () {
            let classroom_id = $(this).val();
            if(classroom_id) {

                $.ajax({
                    url: "{{ url('get-sections')  }}/" + classroom_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data){
                        $('select[name="section_id_new"]').empty();
                        $('select[name="section_id_new"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                })
            }
        });
    });
</script>
