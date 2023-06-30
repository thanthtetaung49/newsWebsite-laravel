@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-5 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categorySubmit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input class="form-control" id="categoryName" name="categoryName" type="text"
                                   value="{{ old('categoryName') }}" placeholder="Enter category name..." />
                            @error('categoryName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">Category Description</label>
                            <textarea class="form-control" id="categoryDescription" name="categoryDescription" type="text"
                                      placeholder="Enter category description...">{{ old('categoryDescription') }}</textarea>
                            @error('categoryDescription')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category list</h3>

                    <div class="card-tools">
                        <form action="{{ route('category') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input class="form-control float-right" name="categorySearch" type="text"
                                       value="{{ request('categorySearch') }}" placeholder="Search">

                                <div class="input-group-append">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($categoryData) > 0)
                                @foreach ($categoryData as $data)
                                    <tr>
                                        <td class="align-middle">{{ $data->id }}
                                            <input id="inputId" type="hidden" value="{{ $data->id }}">
                                        </td>
                                        <td  class="align-middle"id="inputTitle">{{ $data->title }}</td>
                                        <td class="align-middle" id="inputDescription">{{ Str::words($data->description, 5, '...')  }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm bg-dark text-white edit-btn" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" title="update"><i
                                                   class="fas fa-edit"></i></button>
                                            <a href="{{ route('categoryDelete', $data->id) }}">
                                                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"
                                                       title="delete"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">This is no cateogry data...</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="mt-3">
                {{ $categoryData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category Form</h1>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categorySubmit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categoryUpdateName">Category Name</label>
                            <input class="form-control" id="categoryUpdateName" name="categoryName" type="text"
                                   value="{{ old('categoryName') }}" placeholder="Enter category name..." />
                            <span class="name-error text-danger">Category name field is required.</span>
                        </div>
                        <div class="form-group">
                            <label for="categoryUpdateDescription">Category Description</label>
                            <textarea class="form-control" id="categoryUpdateDescription" name="categoryDescription" type="text"
                                      placeholder="Enter category description...">{{ old('categoryDescription') }}</textarea>
                            <span class="description-error text-danger">Category description field is required.</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn bg-primary" id="updateButton" type="button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            let updateData = {};

            $(".edit-btn").click(function(e) {
                e.preventDefault();
                let getInputId = $(this).parents("tr").find("#inputId").val();
                let getInputTitle = $(this).parents("tr").find("#inputTitle").text();
                let getInputDescription = $(this).parents("tr").find("#inputDescription").text();

                updateData.id = getInputId;
                updateData.inputTitle = getInputTitle;
                updateData.inputDescription = getInputDescription;

                $("#categoryUpdateName").val(updateData.inputTitle);
                $("#categoryUpdateDescription").val(updateData.inputDescription);
            });

            errorStatusHide();

            $("#updateButton").click(function(e) {
                e.preventDefault();

                let getCategoryUpdateName = $("#categoryUpdateName").val();
                let getCategoryUpdateDescription = $("#categoryUpdateDescription").val();

                $("#categoryUpdateName").val() == "" ? $(".name-error").show() : $(".name-error").hide();
                $("#categoryUpdateDescription").val() == "" ? $(".description-error").show() :
                    $(".description-error").hide();

                if (getCategoryUpdateName != "" && getCategoryUpdateDescription != "") {
                    updateData.name = getCategoryUpdateName;
                    updateData.description = getCategoryUpdateDescription;

                    $("#categoryUpdateName").val("");
                    $("#categoryUpdateDescription").val("");

                    $.ajax({
                        type: "get",
                        url: "/category/update",
                        data: updateData,
                        dataType: "json",
                        success: function(response) {
                            if (response.categoryUpdateStatus == "success") {
                                location.href = "/category";
                            }
                        }
                    });
                }
            });

            $(".btn-close").click(function(e) {
                e.preventDefault();
                errorStatusHide();
            });

            $(document).click(function(e) {
                if ($(e.target).hasClass("modal")) {
                    errorStatusHide();
                }
            });

            function errorStatusHide() {
                $(".name-error").hide();
                $(".description-error").hide();
            }

        });
    </script>
@endsection
