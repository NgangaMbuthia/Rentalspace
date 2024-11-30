<div class="table-responsive" style="margin-top:0.3%;">
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>

                        <th>Credit</th>

                        <th>Debit</th>
                        <th>Balance</th>

                        
                        
                        </tr>
                       
                        <tbody>
                        <?php $i=1; foreach($tenancy as $tenant):?>
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$tenant->user->name?></td>
                        <td><?=$tenant->entry_date;?></td>
                        <td><?=$tenant->expected_end_date;?></td>
                        <td><?=$tenant->current_status;?></td>
                        <td><?=$tenant->getCredit($tenant->id);?></td>
                        <td><?=$tenant->getDebit($tenant->id);?></td>
                        <td><?=$tenant->getDebit($tenant->id)-$tenant->getCredit($tenant->id);?></td>
                            
                        </tr>
                         
                         <?php $i++;endforeach;?>
                          
                        </tbody>
                         </table>
                          

                        </div>