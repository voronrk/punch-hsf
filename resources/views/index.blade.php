<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/resources/css/bulma.min.css">
    <link rel="stylesheet" href="/resources/css/style.css">

    <script type="module" src="/resources/js/admin.js" defer></script>
    <title>Каталог штанц-форм</title>
</head>
<body>
    <div class="container">
        <nav class="navbar">
        <div class="navbar-end">
            <div class="navbar-item">
            <div class="buttons">
                <a class="button is-primary">
                <strong>Войти</strong>
                </a>
            </div>
            </div>
        </div>
        </nav>

        <section class="section">
        <form class="form" enctype="multipart/form-data" id="addPunch" method="POST" action="/api/punch.add">
            @csrf
            <div class="field" >
                       <label class="label">Название штампа</label>
                       <input type="text" class="input is-small" name="title" value = "{{ old('title') }}">
                        @if ($errors->first('title'))
                          <p class="help is-danger">{{ $errors->first('title') }}</p>
                        @endif
                   </div>
            <div class="columns">
                <div class="column is-3">
                <div class="field" id="products">
                    <label class="label">Виды продукции</label>
                    @if ($errors->first('products'))
                      <p class="help is-danger">{{$errors->first('products')}}</p>
                    @endif
                    <div class="field-wrapper-full">
                        <?php
                            foreach($products as $product) {
                                if ((is_array(old('products'))) && (in_array($product['id'], old('products')))) $flag = 'checked'; else $flag = '';?>
                                <label class="checkbox"><input type="checkbox" {{ $flag }} name="products[]" value="{{ $product['id'] }}">{{ $product['value'] }}</label>
                        <?php }; ?>
                    </div>
                </div>
                   
                   <div class="field" id="materials">
                       <label class="label">Виды материалов</label>
                        @if ($errors->first('materials'))
                          <p class="help is-danger">{{$errors->first('materials')}}</p>
                        @endif
                       <div class="field-wrapper-full">
                       <?php
                            foreach($materials as $material) {
                                if ((is_array(old('materials'))) && (in_array($material['id'], old('materials')))) $flag = 'checked'; else $flag = '';?>
                                <label class="checkbox"><input type="checkbox" {{ $flag }} name="<?php echo 'materials[]';?>" value="<?php echo $material['id']?>"><?php echo $material['value']?></label>
                            <?php }; ?>
                       </div>
                   </div>

                   <div class="field" id="machines">
                       <label class="label">Оборудование</label>
                        @if ($errors->first('machines'))
                          <p class="help is-danger">{{$errors->first('machines')}}</p>
                        @endif
                       <div class="field-wrapper-full">
                       <?php
                            foreach($machines as $machine) {
                                if ((is_array(old('machines'))) && (in_array($machine['id'], old('machines')))) $flag = 'checked'; else $flag = '';?>
                                <label class="checkbox"><input type="checkbox" {{ $flag }} name="<?php echo 'machines[]';?>" value="<?php echo $machine['id']?>"><?php echo $machine['value']?></label>
                        <?php }; ?>
                       </div>
                   </div>
                </div>
                <div class="column is-2">
                <div class="field" id="size-width">
                       <label class="label">Размеры изделия</label>
                       <div class="field is-horizontal">
                           <div class="field-label is-normal">
                             <label class="label has-text-weight-normal">Длина</label>
                           </div>
                           <div class="field-body">
                             <div class="field">
                               <p class="control">
                                 <input class="input  is-small" type="number" name="size-length" value={{ old('size-length') }}>
                                  @if ($errors->first('size-length'))
                                    <p class="help is-danger">{{$errors->first('size-length')}}</p>
                                  @endif
                               </p>
                             </div>
                           </div>
                       </div>
                       <div class="field is-horizontal">
                           <div class="field-label is-normal">
                             <label class="label has-text-weight-normal">Ширина</label>
                           </div>
                           <div class="field-body">
                             <div class="field">
                               <p class="control">
                                 <input class="input  is-small" type="number" name="size-width" value={{ old('size-width') }}>
                                 @if ($errors->first('size-width'))
                                    <p class="help is-danger">{{$errors->first('size-width')}}</p>
                                  @endif
                               </p>
                             </div>
                           </div>
                       </div>
                       <div class="field is-horizontal">
                           <div class="field-label is-normal">
                             <label class="label has-text-weight-normal">Высота</label>
                           </div>
                           <div class="field-body">
                             <div class="field">
                               <p class="control">
                                 <input class="input  is-small" type="number" name="size-height" value={{ old('size-height') }}>
                                 @if ($errors->first('size-height'))
                                    <p class="help is-danger">{{$errors->first('size-height')}}</p>
                                  @endif
                               </p>
                             </div>
                           </div>
                       </div>
                   </div>

                   <div class="field" id="size-knife">
                       <label class="label">Размеры по ножам</label>
                       <div class="field is-horizontal">
                           <div class="field-label is-normal">
                             <label class="label has-text-weight-normal">Длина</label>
                           </div>
                           <div class="field-body">
                             <div class="field">
                               <p class="control">
                                 <input class="input  is-small" type="number" name="knife-size-length" value={{ old('knife-size-length') }}>
                                 @if ($errors->first('knife-size-length'))
                                    <p class="help is-danger">{{$errors->first('knife-size-length')}}</p>
                                  @endif
                               </p>
                             </div>
                           </div>
                       </div>
                       <div class="field is-horizontal">
                           <div class="field-label is-normal">
                             <label class="label has-text-weight-normal">Высота</label>
                           </div>
                           <div class="field-body">
                             <div class="field">
                               <p class="control">
                                 <input class="input  is-small" type="number" name="knife-size-width" value={{ old('knife-size-width') }}>
                                 @if ($errors->first('knife-size-width'))
                                    <p class="help is-danger">{{$errors->first('knife-size-width')}}</p>
                                  @endif
                               </p>
                             </div>
                           </div>
                       </div>
                   </div>

                   <div class="field">
                       <label class="label">Год</label>
                       <div class="select is-small">
                            <select name="year" 
                                @if (old('year'))
                                  value = {{ old('year') }}
                                {{-- @else 
                                  value=<?php echo date('Y');?> --}}
                                @endif
                                >
                                <option></option>
                                <?php for ($i=date('Y'); $i>2012; $i--) {?>
                                    <option
                                    @if (old('year') == $i)
                                      selected
                                    @endif
                                    ><?php echo $i; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                   </div>

                   <div class="field" >
                       <label class="label">Номер заказа</label>
                       <input type="text" class="input is-small" name="ordernum" value={{ old('ordernum') }}>
                   </div>

                   <div class="field" id="pic">
                       <label class="label">Картинка</label>
                        <input type="file" class="input is-small" name='pics[]' value = {{ old('pics') }}>
                       <div class="field-add is-size-7 has-text-info">Добавить</div>
                   </div>

                   <div class="field" >
                    <button class="button is-primary" id="submit" type="submit">Сохранить</button>
                   </div>
                   <div class="field" >
                    <button class="button is-primary" id="cancel" type="reset">Очистить</button>
                   </div>
                </div>
            </div>
            </form>
        </section>
    </div>
</body>
</html>