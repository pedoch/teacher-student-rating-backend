<h3>Thank you, {{ $name }} for signing up to Somstores!</h3>
<p>Confirm your account by clicking:
    <strong>
        <button class="but">
            <a href="{{ url('http://127.0.0.1:8000/api/confirm-account/'. $confirmID)}}">confirm account</a>
        </button>
    </strong>
</p>
<p>If you have any questions please send an email to {{'somstores@gmail.com'}} and we’ll get back to you!</p>
<p>Sincerely</p>
<p>Nicole from Somstores</p>

<style>
    .but{
        height: 30px;
        background: #838ae4;
        color: #fbfbfb;
        border-radius: 5px;
        border: 1px saddlebrown;
        cursor: pointer;
        font-size: 18px;
    }
</style>