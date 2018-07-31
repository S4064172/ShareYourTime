<div class="modal fade" id="jobsModal" tabindex="-1" role="dialog" aria-labelledby="jobsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">            
        <div class="container myContainer-padding">
          <div class="row">
            <div class="col-12 text-center">
              <label><b>Descrizione</b></label>
              <input onfocusout="checkDescription('modalDescription','errModalDescription');" onfocusin="cleanErr('errModalDescription');" id="modalDescription" class="inputTextModal" type="text" name="description" minlength=<?php echo DescriptionMinLength?> maxlength=<?php echo DescriptionMaxLength?>>
              <p id="errModalDescription"></p>                                                            
            </div>
          </div>
          <div class="row">  
            <div class="col-md-6 text-center">
              <label><b>Costo (in &euro;)</b></label>
              <input onfocusout="checkCost('modalCost','errModalCost')" onfocusin="cleanErr('errModalCost');" id="modalCost" class="inputTextModal" type="text" name="cost">
              <p id="errModalCost"></p>
            </div>
            <div class="col-md-6 text-center">
              <label><b>Distanza (in Km)</b></label>
              <input onfocusout="checkDistance('modalDistance','errModalDistance');" onfocusin="cleanErr('errModalDistance')" id="modalDistance" class="inputTextModal" class="inputTextModal"type="text" name="distance">
              <p id="errModalDistance"></p>
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
            <label><b>Inizio Attività</b></label><br>
			<input onfocusout="/*checkTime('modalDateStart','modalTimeStart','modalDateEnd','modalTimeEnd','errTime');*/" onfocusin="cleanErr('errTime');" id="modalDateStart" class="inputTimeModal" type="date" name="dateStart">
			<input onfocusout="/*checkTime('modalDateStart','modalTimeStart','modalDateEnd','modalTimeEnd','errTime');*/" onfocusin="cleanErr('errTime');" id="modalTimeStart" class="inputTimeModal" type="time" name="timeStart">
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
	            <label><b>Fine Attività</b></label><br>
				<input onfocusout="/*checkTime('modalDateStart','modalTimeStart','modalDateEnd','modalTimeEnd','errTime');*/" onfocusin="cleanErr('errTime');" id="modalDateEnd" class="inputTimeModal" type="date" name="dateEnd">
				<input onfocusout="/*checkTime('modalDateStart','modalTimeStart','modalDateEnd','modalTimeEnd','errTime');*/" onfocusin="cleanErr('errTime');" id="modalTimeEnd" class="inputTimeModal" type="time" name="timeEnd">
            	<p id="errTime"></p>
            </div>
          </div>
          <div class="row">  
            <div class="col-md-8 text-center">
            	<label><b>Via</b></label>
		        <input onfocusout="checkStreet('modalStreet','errModalStreet');" onfocusin="cleanErr('errModalStreet')" id="modalStreet" class="inputTextModal" type="text" name="street" minlength=<?php echo StreetMinLength?> maxlength=<?php echo StreetMaxLength?> > 
            	<p id="errModalStreet"></p>
        	</div>
            
			<div class="col-md-4 text-center"> 
        	    <label><b>Tag</b></label>
				<select id="optionModalTag" onfocusin="cleanErr('errModalTag')" onchange="checkTagField('optionModalTag','errModalTag')" class="inputTagModal" name="tag">
					<option selected disabled>Scegli il tag</option>
					<?php
						require_once('../db/connection.php');
	
						$getJobsQuery = "SELECT Tag FROM ShareYourTagsTime ORDER BY Tag ASC;";
						$conn = connectionToDb();
				
						if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
							die('Errore nella selezione dei lavori');

						while( $row = mysqli_fetch_array($res) ) 
							echo '<option class="checkbox">'.$row['Tag'].'</option>';

						mysqli_free_result($res);
						mysqli_close($conn);
					?>	
				 </select>
				 <p id="errModalTag"></p>
			</div>
          </div>
        </div>
      </div>  
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
        <button type="button" class="btn btn-success" id="modButton" onclick="checkJobAllFields()"></button>
      </div>
    </div>
  </div>
</div>

