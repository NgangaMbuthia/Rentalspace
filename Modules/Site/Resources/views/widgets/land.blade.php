<form action="<?=url('/application/land/search')?>" method="get">
                        <label for="location">

                            <input type="text"  name="location" id="autocomplete2"  placeholder="Enter Location">
                        </label>
                        
                        <label for="min-price">
                           <input class="range-slider2" type="hidden" name="price" value="50000,90000000"/>
                       
                           </label>
                        
                       
                       
                        <button type="submit">
                            Search Inventory
                        </button>
                    </form>