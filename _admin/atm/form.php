<form  id="manage">  
        <div class="alert info">ATM Location Input </div> 
        <div class="g12">
                <label>Bank Supplier</label>
                <select name="bank_id" id="bank_id">
                	<option value="1">ACB</option>
                </select>
        </div>
        <div class="g12">
                <label>ATM Name</label>
                <input type="text" class="field text large"  name="atm_name"  id="atm_name"/>
        </div>
       
        <div class="g12">
                <label>ATM Address (auto complete)</label>
                <input type="text" class="field text large"  name="atm_address"  id="atm_address"/>
        </div>
        <div  class="g12">
                <div id="map" style="width:100%;height:450px;">aa</div>  
            
        </div>    
        <div class="g6">
                <label>ATM Latitude (auto complete)</label>
                <input type="text" class="field text large"  name="latitude"  id="latitude"/>
        </div>
        <div class="g6">
                <label>ATM Longitude (auto complete)</label>
                <input type="text" class="field text large"  name="longitude"  id="longitude"/>
        </div>  
         <div class="g12">
                <label>Description</label>
                <textarea rows="1" cols="30" class="field textarea small" name="atm_description" id="atm_description">  </textarea>          
        </div>  
        <div class="g12">
        <br/><br/><br/><br/>
              <span class="right">
               <select  id="next_action"  class="field select addr"> 
                    <option value='next' selected='selected' >Add ATM Point</option>
                    <!--
                    <option value='preview'>Xem trước </option>
                    
                    <option value='list'>To Page List</option>
                    <option value='front'>View in Homepage</option>
                    -->
                </select>    
                <a id="action" class="btn i_arrow_right icon blue" >Submit</a>
            </span>
        </div>
 
	</form>