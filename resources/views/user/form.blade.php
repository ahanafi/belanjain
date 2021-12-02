<div class="row">
    <div class="col-12 col-md-6">
        {!! Form::label('namaUser', 'Nama', ['class' => 'mb-1']) !!}
        {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'namaUser']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('emailUser', 'Email', ['class' => 'mb-1']) !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'emailUser']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('levelUser', 'Level', ['class' => 'mb-1']) !!}
        {!! Form::select('level',  $levels, null, ['class' => 'form-control', 'id' => 'levelUser']) !!}
    </div>
</div>

<hr>

<div class="row">
    <div class="col-12 col-md-6">
        {!! Form::label('passUser', 'Password', ['class' => 'mb-1']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'passUser']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('confirmPassUser', 'Konfirmasi Password', ['class' => 'mb-1']) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'confirmPassUser']) !!}
    </div>
</div>