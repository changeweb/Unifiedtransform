@extends('layouts.app')
@section('title', __('Stripe Payment'))
@section('content')
<style>
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-6" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Payment')
              </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-{{(\Session::has('error'))?'danger':'success'}}">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('stripe/charge')}}" method="post" id="payment-form">
                        {{ csrf_field() }}
                        <input type="hidden" id="stripe_key" name="stripe_key" value="{{env('STRIPE_KEY')}}">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('Enter your credit card information')</h3>
                            </div>
                            <div class="panel-body">
                              <div class="form-group">
                                <label for="amount">@lang('Pay Fee For')</label>
                                <select class="form-control" name="charge_field" required>
                                  @foreach ($fees_fields as $fees_field)
                                    <option>{{$fees_field->fee_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                                <div class="form-group">
                                  <label for="amount">@lang('Amount')</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type=number step="any" class="form-control" id="amount" name="amount" placeholder="@lang('Amount')" required>
                                </div>
                                <br>
                                <label for="card-element">@lang('Card Number')</label>
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success" type="submit">@lang('Pay')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
// Create a Stripe client.
var stripe = Stripe(document.getElementById('stripe_key').value);

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection