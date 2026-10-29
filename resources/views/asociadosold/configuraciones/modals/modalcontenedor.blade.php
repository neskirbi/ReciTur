<!-- ModalRegistro -->
<div class="modal fade" id="mcontenedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
        
            <form action="Contenedor" method="POST" id="formcancelar">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contenedor</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body">

                    <div class="form-group">
                        <label for="contenedor">Contenedor</label>
                        <input required type="text" class="form-control" id="contenedor" name="contenedor" >                        
                    </div>

                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input required type="number" min="0.0" step="0.1" class="form-control" id="cantidad" name="cantidad" >                        
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