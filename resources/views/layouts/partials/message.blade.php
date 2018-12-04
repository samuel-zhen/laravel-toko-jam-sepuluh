@if (session()->has('success'))
    <div class="ui horizontal divider"></div>
    <div class="ui success message">
        <p>
            <i class="check circle icon"></i> {{ session('success') }}
        </p>
    </div>
@endif