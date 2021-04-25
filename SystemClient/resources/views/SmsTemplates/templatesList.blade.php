@extends('welcome')

@section('script')
    <script>
        function addTemplate(){
            var params =  $('#addTemplateForm').serialize();
            $.ajax({
                type:'POST',
                url:'/addTemplate',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "params" : params
                },
                success:function(data) {
                    console.log(data)
                }
            });
        }

        function add(element){
            var value = element.getAttribute('value');
            $('#tekst').val($('#tekst').val() + value)
        }

    </script>
@endsection

@section('adminNavbarSection')
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Hurtowników</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Lista Klientów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Custom Fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Kategorie produktów</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Produkty</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Etykiety</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/gateways">Bramki SMS</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/templatesList">Szablony SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/settings">Ustawienia</a>
    </li>
@endsection

@section('body')
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Content</th>
        <th style="text-align: end"><button class="btn btn-primary" data-toggle="modal" data-target="#addTemplate"><i class="fa fa-plus"></i> Add Template</button></th>
    </tr>
    </thead>
    <tbody>
        @foreach($templates as $template)
        <tr>
            <td>{{$template->name}}</td>
            <td>{{ \Illuminate\Support\Str::limit($template->content, 50, $end='...') }}</td>
            <td><button>Edit</button></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="addTemplate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body row">
                <div class="col-sm-6">
                    <form id="addTemplateForm" action="/addTemplate" method="POST">
                        <div class="form-group">
                            <label>Nazwa:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Tekst:</label>
                            <textarea id="tekst" class="form-control" rows="5" name="content" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    @foreach($variables as $category=>$tplvariables)
                        <div class="template-variable-category" data-toggle="collapse" data-target="#{{$category}}">{{$category}} </div>
                        <div id="{{$category}}" class="collapse template-variable-container">
                            @foreach($tplvariables as $variable)
                                <div class="template-variable" onclick="add(this)" value="{{$variable}}">{{$variable}}</div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addTemplate()" data-dismiss="modal">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection




