
@extends('admin.layout.admin_master')

@section('content')

<div id="content">

  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.html" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="#">Payments</a>
      <a href="#" class="current">Add Payment Method</a>
    </div>

    <h1>Add Payment Method</h1>
  </div>

  <div class="container-fluid">
    <hr>

    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">

          <div class="widget-title">
            <span class="icon">
              <i class="icon-info-sign"></i>
            </span>
            <h5>Add Payment Method</h5>
          </div>

          <div class="widget-content nopadding">

            <form
              class="form-horizontal"
              method="post"
              action="{{ url('/admin/add_payment') }}"
              name="basic_validate"
              novalidate="novalidate"
            >

              @csrf

              <div class="control-group">
                <label class="control-label">Account Name</label>
                <div class="controls">
                  <input type="text" name="account_name" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Account Number</label>
                <div class="controls">
                  <input type="text" name="account_number" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Bank Name / Mobile Company</label>
                <div class="controls">
                  <input type="text" name="bank_name" required>
                </div>
              </div>

              <div class="control-group" id="routing_number_div">
                <label class="control-label">Routing Number</label>
                <div class="controls">
                  <input
                    type="text"
                    name="routing_number"
                    id="routing_number"
                    placeholder="Enter routing number"
                  >
                </div>
              </div>

              <div class="control-group" id="branch_name_div">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <input
                    type="text"
                    name="branch_name"
                    id="branch_name"
                    placeholder="Enter branch name"
                  >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Payment Type</label>
                <div class="controls">
                  <select name="type" id="payment_type" required>
                    <option value="bank">Bank Transfer</option>
                    <option value="mobile">Mobile Banking</option>
                  </select>
                </div>
              </div>

              <div
                class="control-group"
                id="mobile_company_div"
                style="display:none;"
              >
                <label class="control-label">Mobile Company</label>
                <div class="controls">
                  <select name="mobile_company">
                    <option value="bkash">bKash</option>
                    <option value="nagad">Nagad</option>
                    <option value="rocket">Rocket (DBBL)</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Order By</label>
                <div class="controls">
                  <input type="number" name="order_by" value="0">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>

              <div class="form-actions">
                <input
                  type="submit"
                  value="Add Payment Method"
                  class="btn btn-success"
                >
              </div>

            </form>

          </div>

        </div>

      </div>
    </div>

  </div>

</div>

<script>
document.getElementById('payment_type').addEventListener('change', function () {

    var mobileDiv = document.getElementById('mobile_company_div');
    var routingDiv = document.getElementById('routing_number_div');
    var branchDiv = document.getElementById('branch_name_div');

    if (this.value === 'mobile') {

        mobileDiv.style.display = 'block';
        routingDiv.style.display = 'none';
        branchDiv.style.display = 'none';

        document.getElementById('routing_number').value = '';
        document.getElementById('branch_name').value = '';

    } else {

        mobileDiv.style.display = 'none';
        routingDiv.style.display = 'block';
        branchDiv.style.display = 'block';

    }

});
</script>

@endsection

