<div class="col-lg-4">
    <div class="checkout__order">
        <h5>Order Summary</h5>

        <div class="checkout__order__total">
            <ul>
                <li>Total <span>₹ @php echo Session::get('cart_total'); @endphp</span></li>
                <input type="hidden" name="total_amt" id="total_amt" value="@php echo Session::get('cart_total'); @endphp" />
                <li>Delivery Charges <span class="freee">Free</span></li>
                <!-- <li>
                    <form>
                        @csrf
                        Apply Coupon 
                        <input type="text" placeholder="Code" name="coupon_code" id="coupon_code" /> 
                        <input type="button" value="Apply" onclick="apply_coupon()" />
                    </form>
                </li> -->
            </ul>
        </div>
        <div class="checkout__order__youpay">
            <ul>
                <li>You Pay Total<span>₹ @php echo Session::get('cart_total'); @endphp</span></li>
            </ul>
        </div>
    </div>
</div>