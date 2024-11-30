<form action="<?=url('/application/property/search')?>" method="get">
                        <label for="location">

                            <input type="text"  name="location" id="autocomplete1"  placeholder="Enter Location">
                        </label>
                          

                          <div class="row">
                        <label for="price-range">
                            <span>Price Range</span>
                            <input type="text" id="price-range" name="price" value="" data-min=1000 data-max=2000000 class="range" />

                        </label>
                        
                        </div>
                        
                       
                       
                         <label for="Property category">
                            <span>Property Type</span>
                            <select name="category_id" id="type">
                                <option value="">Any</option>
                                 <?php foreach($categories as $subcat):?>
                                   <option value="<?=$subcat->id;?>"><?=$subcat->name;?></option>
                                <?php endforeach;?>
                                 
                                
                            </select>
                        </label>
                           <label for="Property category">
                            <span>Property Category</span>
                            <select name="sub_category" id="category">
                                <option value="">Any</option>
                                 <?php foreach($sub_categories as $subcat):?>
                                   <option><?=$subcat->name;?></option>
                                <?php endforeach;?>
                                 
                                
                            </select>
                        </label>
                        <button type="submit">
                            Search Inventory
                        </button>
                    </form>