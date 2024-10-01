@extends('backend.layouts.app')

@section('page.name', 'Website Pages')

@section('page.content')
<div class="card">
   <div class="card-body">
   <div class="row mb-2">
         <div class="col-sm-5">
            <!--<h3>List</h3>-->
         </div>
         {{-- <div class="col-sm-7">
            <div class="text-sm-end">
                <a href="javascript:void(0);" class="btn btn-danger mb-2" onclick="largeModal('{{ url(route('custom-pages.create')) }}', 'Add')"><i class="mdi mdi-plus-circle me-2"></i> Add Page</a>
            </div>
         </div> --}}
         <!-- end col-->
      </div>

      <div class="row mb-2">
         <div class="col-sm-5">
            <!--<h3>List</h3>-->
         </div>
         <div class="col-sm-7">
			{{--
            <div class="text-sm-end">
                <a href="javascript:void(0);" class="btn btn-danger mb-2" onclick="smallModal('{{ url(route('page.add')) }}', 'Add Page')"><i class="mdi mdi-plus-circle me-2"></i> Add Page</a>
            </div>
			--}}
         </div>
         <!-- end col-->
      </div>
      <div class="table-responsive">
      <table id="basic-datatable" class="table dt-responsive nowrap1 w-100">
	  <thead>
            <tr>
                <th data-breakpoints="lg">#</th>
                <th>Name</th>
                <th data-breakpoints="md">URL</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
		<tbody>
        	@foreach (\App\Models\Page::all() as $key => $page)
        	<tr>
        		<td>{{ $key+1 }}</td>
        		
				@if($page->type == 'home_page')
        			<td>{{ $page->title }}</td>
					<td><a target="_blank" href="{{ route('index') }}">{{ route('index') }}</a></td>
                    @else
                    <td>{{ $page->title }}</td>
					<td><a target="_blank" href="{{ route('index') }}/{{ $page->slug }}">{{ route('index') }}/{{ $page->slug }}</a></td>
				@endif
        		<td class="text-right">
					@if($page->type == 'home_page')
					<a href="javascript:void(0);" class="action-icon" onclick="largeModal('{{ url(route('custom-pages.edit', ['id'=>$page->slug, 'lang'=>env('DEFAULT_LANGUAGE'), 'page'=>'home'] )) }}', 'Edit')"> <i class="mdi mdi-square-edit-outline" title="Edit"></i></a>
					@else
					<a href="javascript:void(0);" class="action-icon" onclick="largeModal('{{ url(route('custom-pages.edit', ['id'=>$page->slug, 'lang'=>env('DEFAULT_LANGUAGE'), 'page'=>$page->id] )) }}', 'Edit')"> <i class="mdi mdi-square-edit-outline" title="Edit"></i></a>
					@endif
					{{-- @if($page->type == 'custom_page')
					<a href="javascript:void(0);" class="action-icon" onclick="confirmModal('{{ url(route('custom-pages.destroy', $page->id)) }}', responseHandler)"><i class="mdi mdi-delete" title="Delete"></i></a>
          			@endif --}}
        		</td>
        	</tr>
        	@endforeach
        </tbody>
        
    </table>
      </div>
   </div>
   <!-- end card-body-->
</div>
@endsection

@section("page.scripts")
<script>
    var responseHandler = function(response) {
        location.reload();
    }
</script>
@endsection