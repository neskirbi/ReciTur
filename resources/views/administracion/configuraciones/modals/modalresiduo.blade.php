<!-- ModalRegistro -->
<div class="modal fade" id="mresiduo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
        
            <form action="Residuo" method="POST" id="formcancelar">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Residuo</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body">

                    <div class="form-group">
                        <label for="nombrec">Residuo</label>
                        <input required type="text" class="form-control" id="residuo" name="residuo" >                        
                    </div>

                    <div class="form-group">
                        <label for="nombrec">Precio</label>
                        <input required type="number" min="0.0" step="0.1" class="form-control" id="precio" name="precio" >                        
                    </div>

                    <div class="form-group">
                        <label for="nombrec">Unidades</label>
                        <input required type="text" class="form-control" id="unidades" name="unidades" >                        
                    </div> 
                    
                    <div class="form-group">
                        <label for="nombrec">Opción</label>
                        <input required type="text" class="form-control" id="opcion" name="opcion" >                        
                    </div> 
                 
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Confirmar</button>
              </div>
            </div> 
            </form>
        </div>
    </div>
</div>