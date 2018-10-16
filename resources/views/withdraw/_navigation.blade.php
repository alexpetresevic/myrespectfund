<div class="withdraw-overview">
    <ul>
        <li class="{{ request()->route()->getName() === 'withdraw.index' ? 'withdraw-active' : 'withdraw-unavailable' }}"><a class="withdraw-navigation" href="">1. withdrawal verification</a></li>
        <li class="{{ request()->route()->getName() === 'withdraw.two' ? 'withdraw-active' : 'withdraw-unavailable' }}"><a class="withdraw-navigation" href="">2. Success</a></li>
        <li class="{{ request()->route()->getName() === 'withdraw.three' ? 'withdraw-active' : 'withdraw-unavailable' }}"><a class="withdraw-navigation" href="">3. Say thanks</a></li>
        <li class="{{ request()->route()->getName() === 'withdraw.testimonial' ? 'withdraw-active' : 'withdraw-unavailable' }}"><a class="withdraw-navigation" href="">4. Testimonial</a></li>
        <li class="{{ request()->route()->getName() === 'withdraw.leave-tip' ? 'withdraw-active' : 'withdraw-unavailable' }}"><a class="withdraw-navigation" href="">5. Leave a tip</a></li>
    </ul>
</div>
@if($campaign->funeralHome()->exists())
    <div class="funeral-home__information">
        <h3>funeral home</h3>
        <ul class="withdraw-funeral__info">
            <li>
                <p>{{ $campaign->funeralHome->name }}</p>
            </li>
            <li>
                <p>{{ $campaign->funeralHome->address }}</p>
            </li>
        </ul>
    </div>
@endif
@push('stack-script')
    <script>
        $('.withdraw-navigation').on('click', function (e){
            e.preventDefault();
        });
    </script>
@endpush