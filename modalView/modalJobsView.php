<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
              
        <div class="container myContainer-padding">
          <div class="row">
            <div class="col-12 text-center">
              <label><b>Descrizione</b></label>
              <input onfocusout="" onfocusin="cleanErr('')" id="modalDescription" type="textModal" name="description" minlength=<?php echo DescriptionMinLength?> maxlength=<?php echo DescriptionMaxLength?>>
              <p id=""></p>                                                            
            </div>
          </div>
          <div class="row">  
            <div class="col-12 text-center">
              <label ><b>Costo</b></label>
              <input onfocusout="" onfocusin="cleanErr('')" id="modalCost" type="textModal" name="cost">
              <p id=""></p>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
            <label><b>Inizio Attività</b></label>
            <input onfocusout="" onfocusin="cleanErr('')" id="modalTimeStart" type="textModal" name="timeStart">
            <p id=""></p>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
            <label><b>Fine Attività</b></label>
            <input  onfocusout="" onfocusin="cleanErr('')" id="modalTimeEnd" type="textModal" name="timeEnd">
            <p id=""></p>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
            <label><b>Distanza</b></label>
            <input onfocusout="" onfocusin="cleanErr('')" id="modalDistance" type="textModal" name="distance">
            <p id=""></p>
            </div>
          </div>  
          <div class="row">  
            <div class="col-12 text-center">
            <label><b>Via</b></label>
            <input onfocusout="" onfocusin="cleanErr('')" id="modalStreet" type="textModal" name="street" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> required> 
            <p id=""></p>
            </div>
          </div>
        </div>
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
