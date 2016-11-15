<div class="sidebar" id="sidebar" style="margin-top: 50px;">
    <ul class="nav" id="side-menu">
        <li><a href="javascript: ;" class="ajaxLink" id="personal-information">Personal Information</a></li>
        <li><a href="javascript: ;" class="ajaxLink" id="change-password">Change Password</a></li>
        <li><a href="javascript: ;" class="ajaxLink" id="preferences">Preferences</a></li>
    </ul>
</div>
<div id="ajaxContent" class="gray-bg sidebar-content"></div>

@section('js')
    <script>
        $('#side-menu').metisMenu();
    </script>
@stop

<script>
    @section('onReadyJs')
    var url   = location.href;
    var parts = url.split('#');
    var baseURL = '/user/';

    if (parts[1] != null) {
        $('#'+ parts[1]).parent().addClass('active');
        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load(baseURL + parts[1]);
    } else {
        $('#personal-information').parent().addClass('active');
        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load(baseURL + $('#personal-information').attr('id'));
    }
    $('.ajaxLink').click(function() {

        $('.ajaxLink').parent().removeClass('active');
        $(this).parent().addClass('active');

        var link = $(this).attr('id');
        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load(baseURL + link);
    });
    @stop
</script>