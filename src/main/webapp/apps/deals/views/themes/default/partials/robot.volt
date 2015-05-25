<script id="robot-template" type="text/x-handlebars-template">
    <div class="modal-wrapper">
        <div class="modal-box">
            <div class="modal-container">
                <div class="modal-row">
					<img src="/n/themes/deals/images/assets/close_exit.png" title="close modal-wrapper" class="cancel-action" width="25" height="25">
                    <h3>Search all of HotelClub</h3>
                </div>
                <div class="modal-row">
                    <p>Where would you like to go?<br />
                        <input name="" type="text" class="modal-input modal-marker" value="City"/></p>
                </div>
                <div class="modal-row">
                    <div class="six columns">
                        <p>Check-in and Check-out<br />
                        <div class="modal-calendar">
                            <!--<select name="" class="modal-dropdown-select-date">
                                <option>JQuery date picker</option>
                            </select>-->
							<input name="check-in" type="text" class="modal-input-date" id="check-in"/>&nbsp;
							<input name="check-out" type="text" class="modal-input-date" id="check-out"/>
							</div></p>
                    </div>
                    <div class="six columns">
                        <div class="four columns">
                            <p>Rooms<br />
                                <select name="" class="modal-dropdown-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select></p>
                        </div>
                        <div class="four columns">
                            <p>Adults<br />
                                <select name="" class="modal-dropdown-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select></p>
                        </div>
                        <div class="four columns">
                            <p>Children<br />
                                <select name="" class="modal-dropdown-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select></p>
                        </div>
                    </div>
                </div>
                <div class="modal-row">
                    <div class="six columns">
                        <p>Search hotel name<br />
                            <input name="" type="text" class="modal-input" value="e.g. Sydney Hilton"/></p>
                    </div>
                    <div class="six columns">
                        <p>Apply promo code<br />
                            <input name="" type="text" class="modal-input" value="Enter code"/></p>
                    </div>
                </div>
                <div class="modal-row">
                    <div class="twelve columns">
                        <a href="#" title="Search" class="modal-row-button">Search hotels</a>
                    </div>
                    <div class="twelve columns">
                       <p class="modal-cancel cancel-action"><small>Cancel</small></p> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</script>