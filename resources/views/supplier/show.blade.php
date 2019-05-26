<!-- Modal -->
<div class="modal fade" id="show_data" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Details of Suppliers</h4>
        </div>
          <div class="modal-body">
            <dl>
              <dd>Supplier Name</dd>
                <dt>
                  {{$supplier[0]['supplier_name']}}
                </dt>
              <dd>Created On</dd>
                <dt>
                  {{$supplier[0]['created_at']}}
                </dt>
            </dl>
          </div>
    </div>
          </div>
      </div>
      
      </div>
</div>
    <!-- modal -->