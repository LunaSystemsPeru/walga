<div class="modal fade" id="exampleModalSignup" tabindex="-1" role="dialog" aria-labelledby="exampleModalDefaultSignup" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalDefaultLogin">Modificar Detalle del Servicio</h6>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <form class="form-horizontal auth-form" action="lista-contratos.php" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="input-documento">Descripcion</label>
                        <div class="input-group">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label class="form-label" for="input-documento">Origen</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fecha-inicio" name="fecha_inicio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-documento">Destino</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fecha-inicio" name="fecha_inicio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-documento">Monto Aprobado</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control" id="fecha-inicio" name="fecha_inicio">
                        </div>
                    </div>
                </div><!--end auth-page-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-soft-primary btn-sm">Modificar</button>
                    <button type="button" class="btn btn-soft-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                </div><!--end modal-footer-->
            </form><!--end form-->
        </div><!--end modal-body-->
    </div><!--end modal-content-->
</div><!--end modal-dialog-->