@extends('admin.layouts.app')


@section('content')

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Shipping</h1>
            </div>
        </div>
    </div>
    @include('admin.message')
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
    <form action="" method="POST" id="shippingForm" name=shippingForm>
        {{-- @csrf --}}
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select Country</option>
                                @if ($countries->isNotEmpty())
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                    <option value="rest_of_world">Rest of the world</option>
                                @endif
                            </select>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">	
                            <p></p>
                        </div>
                    </div>	
                    <div class="pt-4 mx-3">
                        <button class="btn btn-primary">Create</button>
                    </div>					
                </div>
            </div>							
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Shipping</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <form action="" method="get">
            <div class="card-header">
                <div class="card-title">
                    <button type="reset" onclick="window.location.href='{{route('shipping.create')}}'" class="btn btn-sm btn-default">Reset</button>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Country</th>
                            <th>Amount</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($shippingCharges->isNotEmpty())
                            @foreach($shippingCharges as $shipping)
                            <tr>
                                <td>{{$shipping->id}}</td>
                                <td>{{ ($shipping->country_id == 'rest_of_world') ? 'Rest of the world' : $shipping->country }}</td>
                                <td>{{$shipping->amount}}</td>
                            <td>
                                <a href="{{route('shipping.edit', $shipping->id)}}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="javascrip:void(0);" onclick="deleteShipping({{$shipping->id}})" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </td>
                            </tr>
                            @endforeach

                        @else
                        <tr>
                            <td colspan="5">Records Not Found</td>
                        </tr>
                            

                        @endif
                          </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{-- {{$shippingCharges->links()}} --}}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>

@endsection


@section('customJs')

<script>
$('#shippingForm').submit(function() {
		event.preventDefault();
		$("button[type=submit]").prop('disabled', true);
		var element = $(this);
		$.ajax({
			url: '{{route("shipping.store")}}',
			method: 'post',
			data: element.serializeArray(),
			dataType: 'json',
			success: function(response) {
				$("button[type=submit]").prop('disabled', false);

				let errors = response['error'];
				if (response['status'] == true) {
					window.location.href="{{route('shipping.create')}}";
					$('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
					$('#amount').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
				} else {
					let errors = response['errors'];
					if (errors['country']) {
						$('#country').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['country']);
					} else {
						$('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
					}

					if (errors['amount']) {
						$('#amount').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['amount']);
					} else {
						$('#amount').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
					}
				}

			},
			error: function(jqXHR, exception) {
				console.log('Something went wrong');
			}
		})
	})

    function deleteShipping(id){
        var url = "{{route('shipping.delete', 'ID')}}";
        var newUrl = url.replace('ID', id);
        if(confirm("Are you sure you want to delete this data?")){
            $.ajax({
            url: newUrl,
            type: "delete",
            data: '',
            dataType: 'json',
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            success: function(response){
                window.location.href = "{{route('shipping.create')}}";
            }
        });
        }
    }


</script>

@endsection