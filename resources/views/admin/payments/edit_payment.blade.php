
@extends('admin.layout.admin_master')

@section('content')

<div id="content">

    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="#">Payments</a>
            <a href="#" class="current">Edit Payment Method</a>
        </div>

        <h1>Edit Payment Method</h1>
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
                        <h5>Edit Payment Method</h5>
                    </div>

                    <div class="widget-content nopadding">

                        <form
                            class="form-horizontal"
                            method="post"
                            action="{{ url('/admin/edit_payment/'.$payment->id) }}"
                            name="basic_validate"
                            novalidate="novalidate"
                        >

                            @csrf

                            <!-- Account Name -->
                            <div class="control-group">
                                <label class="control-label">Account Name</label>

                                <div class="controls">
                                    <input
                                        type="text"
                                        name="account_name"
                                        value="{{ $payment->account_name }}"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Account Number -->
                            <div class="control-group">
                                <label class="control-label">Account Number</label>

                                <div class="controls">
                                    <input
                                        type="text"
                                        name="account_number"
                                        value="{{ $payment->account_number }}"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Bank Name -->
                            <div class="control-group">
                                <label class="control-label">Bank Name / Mobile Company</label>

                                <div class="controls">
                                    <input
                                        type="text"
                                        name="bank_name"
                                        value="{{ $payment->bank_name }}"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Routing Number -->
                            <div
                                class="control-group"
                                id="routing_number_div"
                                style="{{ $payment->type == 'bank' ? 'display:block;' : 'display:none;' }}"
                            >
                                <label class="control-label">Routing Number</label>

                                <div class="controls">
                                    <input
                                        type="text"
                                        name="routing_number"
                                        id="routing_number"
                                        value="{{ $payment->routing_number }}"
                                    >
                                </div>
                            </div>

                            <!-- Branch Name -->
                            <div
                                class="control-group"
                                id="branch_name_div"
                                style="{{ $payment->type == 'bank' ? 'display:block;' : 'display:none;' }}"
                            >
                                <label class="control-label">Branch Name</label>

                                <div class="controls">
                                    <input
                                        type="text"
                                        name="branch_name"
                                        id="branch_name"
                                        value="{{ $payment->branch_name }}"
                                    >
                                </div>
                            </div>

                            <!-- Payment Type -->
                            <div class="control-group">
                                <label class="control-label">Payment Type</label>

                                <div class="controls">
                                    <select name="type" id="payment_type" required>
                                        <option
                                            value="bank"
                                            {{ $payment->type == 'bank' ? 'selected' : '' }}
                                        >
                                            Bank Transfer
                                        </option>

                                        <option
                                            value="mobile"
                                            {{ $payment->type == 'mobile' ? 'selected' : '' }}
                                        >
                                            Mobile Banking
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Mobile Company -->
                            <div
                                class="control-group"
                                id="mobile_company_div"
                                style="{{ $payment->type == 'mobile' ? 'display:block;' : 'display:none;' }}"
                            >
                                <label class="control-label">Mobile Company</label>

                                <div class="controls">
                                    <select name="mobile_company">
                                        <option
                                            value="bkash"
                                            {{ $payment->mobile_company == 'bkash' ? 'selected' : '' }}
                                        >
                                            bKash
                                        </option>

                                        <option
                                            value="nagad"
                                            {{ $payment->mobile_company == 'nagad' ? 'selected' : '' }}
                                        >
                                            Nagad
                                        </option>

                                        <option
                                            value="rocket"
                                            {{ $payment->mobile_company == 'rocket' ? 'selected' : '' }}
                                        >
                                            Rocket (DBBL)
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Order By -->
                            <div class="control-group">
                                <label class="control-label">Order By</label>

                                <div class="controls">
                                    <input
                                        type="number"
                                        name="order_by"
                                        value="{{ $payment->order_by }}"
                                    >
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="control-group">
                                <label class="control-label">Status</label>

                                <div class="controls">
                                    <select name="status">
                                        <option
                                            value="1"
                                            {{ $payment->status == 1 ? 'selected' : '' }}
                                        >
                                            Active
                                        </option>

                                        <option
                                            value="0"
                                            {{ $payment->status == 0 ? 'selected' : '' }}
                                        >
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="form-actions">
                                <input
                                    type="submit"
                                    value="Update Payment Method"
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
    function togglePaymentFields() {

        var paymentType = document.getElementById('payment_type').value;

        var mobileDiv = document.getElementById('mobile_company_div');
        var routingDiv = document.getElementById('routing_number_div');
        var branchDiv = document.getElementById('branch_name_div');

        if (paymentType === 'mobile') {

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
    }

    document.getElementById('payment_type').addEventListener('change', function () {
        togglePaymentFields();
    });

    togglePaymentFields();
</script>

@endsection

