Denimculture

<h3>Good day, {{ $name }}</h3>
<p>click here to reset password:</p>
    <strong>
        <button class="but">
            <a href="{{ url('http://127.0.0.1:8000/api/password-reset/'. $confirmID) }}">
                reset password
            </a>
        </button>
    </strong>
<p>If you have any did not request this, kindly click this link
    <button class="but"><a href="{{ url('http://127.0.0.1:8000/api/password-reset/') }}">
            Report</a>
    </button>
</p>
<p>Sincerely</p>
<p>Nicole from Denimculture</p>

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
    .center{
        text-align: center;
    }
</style>