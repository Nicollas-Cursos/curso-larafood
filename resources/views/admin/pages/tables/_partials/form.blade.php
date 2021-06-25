@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="name">Identificador da mesa</label>
    <input type="text" id="identify" name="identify" class="form-control" placeholder="Identificador..."
        value="{{ $table->identify ?? old("identify") }}">
</div>
<div class="form-group">
    <label for="description">Descrição da mesa</label>
    <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $table->description ?? old("description") }}</textarea>
</div>