@extends('backend.layouts.app')

@section('content')

<div class="card p-3">

    <div class="card-header pl-0">

        <div class="main-title d-flex w-100">

                    <h3 class="mb-0">Bulk Import</h3>

                   <div class="">

                        <a href="{{route('excel.brand.download')}}" class="btn btn-primary ml-2">

                            <span class="ti-plus pr-2"></span>

                            Download Brand

                        </a>

                    </div>

                    <div class="">

                        <a href="{{route('excel.location.download')}}" class="btn btn-primary ml-2">

                            <span class="ti-plus pr-2"></span>

                            Download Location

                        </a>

                    </div>

                    <div class="">

                        <a href="{{route('excel.sample.download')}}" class="btn btn-primary ml-2">

                            <span class="ti-plus pr-2"></span>

                            Sample Download

                        </a>

                    </div>

                </div>

    </div>

    <form class="form-horizontal" action="{{route('bulk.import')}}" method="POST" enctype="multipart/form-data">

	{{csrf_field()}}

	<div class="white-box">

		<div class="col-md-12 p-0">

			<div class="row mb-30">

				<div class="col-md-12">

					<div class="row">

						<div class="col-xl-12">

							<p>

								<pl> </pl>

							</p>

							<li>01. You need to import Excel File. For sample you can download by clicking <b>Sample Download</b></li>

							<li>02. Make sure input correct answer in right column.</li>

							<p></p>

							<hr> 

							</div>

							<div class="col-md-4">

							<label class="primary_input_label" for="groupInput">Excel File *</label>

							<input type="file" name="file" id="placeholderFileOneName" class="form-control" required>

							</div>

							<div class="col-md-4 mt-4 text-center">

				<button type="submit" class="btn btn-success">Bulk Import</button>

			</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</form>

</div>

@endsection