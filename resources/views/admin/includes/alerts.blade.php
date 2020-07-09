<!--JQuery -->
<script src="{{url('./vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>


{{-- // --}}
@if ($errors->any())<!-- jQuery -->
<div class="alert alert-warning">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if(session('message'))
{{-- <div class="alert alert-success">
        {{ session('message') }}
</div> --}}
<!--Modal-->                <!--Modal-->            <!--Modal-->
<div class="modal fade" id="teste" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style=" color:white; font-size: 16px; font-weight: bold;" >
                    {{ session('message') }}
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#teste').modal('show');
    });
    var intervalo = window.setInterval(fechar, 5000);
    function fechar() {
        $('#teste').modal('hide');
    }
</script>
@endif



{{-- No caso de dar algum erro --}}         {{-- No caso de dar algum erro --}}
@if(session('error'))

<div class="alert alert-danger">
    {{ session('error') }}
</div>
<div class="modal fade" id="teste_02" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style=" color:white; font-size: 16px; font-weight: bold;" >
                    {{session('error')}}
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    jQuery(document).ready(function () {
        jQuery('#teste_02').modal('show');
    });
    var intervalo = window.setInterval(fechar, 5000);
    function fechar() {
        jQuery('#teste_02').modal('hide');
    }
</script>
@endif






@if(session('info'))
<div class="alert alert-warning">
    {{ session('info') }}
</div>
@endif
