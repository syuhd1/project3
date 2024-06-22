<section>
<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

		<div class="account-settings">
			<div class="user-profile">
                @if($user->picture !== null)
				<div class="user-avatar">
					<img src="/profiles/{{$user->picture}}" alt="">
				</div>
                @else
                <div class="user-avatar">
					<img src="/profiles/avatar.jpg" alt="">
				</div>
                @endif
				<h5 class="user-name" >{{ $user->name}}</h5>
				<h6 class="user-email">{{ $user->email}}</h6>
			</div>

                        <!-- User Picture -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="picture">Update Picture</label>
                    <input type="file" id="picture" name="picture" class="form-control-picture">
                    <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                </div>
            </div>

			<!-- <div class="about">
				<h5>About</h5>
				<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
			</div> -->
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">

    <!-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch') -->

		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Personal Details</h6>
			</div>
        
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Enter full name"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            </div>
            <!-- email -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="eMail">Email</label>
                    <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" placeholder="Enter email address"/>
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- phone -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <!-- <input type="text" class="form-control" id="phone" placeholder="Enter phone number"> -->
                    <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $user->phone)" required autofocus autocomplete="name" placeholder="Enter phone number"/>
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>
            </div>
            <!-- url/address? -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="website">Address</label>
                    <!-- <input type="url" class="form-control" id="website" placeholder="Website url"> -->
                    <x-text-input id="address" name="address" type="text" class="form-control" :value="old('address', $user->address)" required autofocus autocomplete="address" placeholder="Address" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
            </div>


        </div>

        <!-- row gutters 2 -->
        <!-- <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">Address</h6>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="Street">Street</label>
                    <input type="name" class="form-control" id="Street" placeholder="Enter Street">
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="ciTy">City</label>
                    <input type="name" class="form-control" id="ciTy" placeholder="Enter City">
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="sTate">State</label>
                    <input type="text" class="form-control" id="sTate" placeholder="Enter State">
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="zIp">Zip Code</label>
                    <input type="text" class="form-control" id="zIp" placeholder="Zip Code">
                </div>
            </div>

        </div> -->

        <!-- row gutters 3 -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-right">
                    <!-- <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button> -->
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                    
                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- end row gutters -->
    </form>
	</div>
</div>
</div>
</div>
</div>

</section>