@if(count($errors))
    <div class="form-group">
        <div class="alert alert-danger" style="background-color: #005cbf !important; border-color: #005cbf !important">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif