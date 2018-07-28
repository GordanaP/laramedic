@php
    $parse = new Parsedown;
@endphp

<div id="profileDetails">
    <section  id="specialtyDetails">
        <h5 class="font-medium">
            <i class="icon icon-briefcase text-grey mr-3"></i>Specialties
            <a href="#" class="text-warning text-base" id="changeSpecialty">
                {{ $profile->specialty ? 'Change' : 'Add' }}
            </a>
            @if ($profile->specialty)
                <a href="#" class="text-warning text-base" id="deleteSpecialty"><i class="icon icon-trash"></i></a>
            @endif
        </h5>
        <div class="ml-4">
            @php
                echo $parse->text($profile->specialty);
            @endphp
        </div>
    </section>

    <section  id="profileEducation">
        <h5 class="font-medium mt-4">
            <i class="icon icon-graduation text-grey mr-3"></i>Education & Academic Career
            <a href="#" class="text-warning text-base" id="changeEducation">
                {{ $profile->education ? 'Change' : 'Add' }}
            </a>
            @if ($profile->education)
                <a href="#" class="text-warning text-base" id="deleteEducation"><i class="icon icon-trash"></i></a>
            @endif
        </h5>
        <div class="ml-4">
            @php
                echo $parse->text($profile->education);
            @endphp
        </div>
    </section>

    <section id="profileAchievements">
        <h5 class="font-medium mt-4">
            <i class="icon icon-diamond text-grey mr-3"></i>Professional achievements
            <a href="#" class="text-warning text-base" id="changeAchievements">
                {{ $profile->achievements ? 'Change' : 'Add' }}
            </a>
            @if ($profile->achievements)
                <a href="#" class="text-warning text-base" id="deleteAchievements"><i class="icon icon-trash"></i></a>
            @endif
        </h5>
        <div class="ml-4">
            @php
                echo $parse->text($profile->achievements);
            @endphp
        </div>
    </section>

    <section  id="profileHospital">
        <h5 class="font-medium mt-4">
            <i class="fa fa-building-o text-grey mr-3"></i>Hospital Affiliation
            <a href="#" class="text-warning text-base" id="changeHospital">
                {{ $profile->hospital ? 'Change' : 'Add' }}
            </a>
            @if ($profile->hospital)
                <a href="#" class="text-warning text-base" id="deleteHospital"><i class="icon icon-trash"></i></a>
            @endif
        </h5>
        <div class="ml-4">
            @php
                echo $parse->text($profile->hospital);
            @endphp
    </div>
    </section>

    <section id="profileLanguages">
        <h5 class="font-medium mt-4">
            <i class="fa fa-language text-grey mr-3"></i>Foreign languages
            <a href="#" class="text-warning text-base" id="changeLanguages">
                {{ $profile->languages ? 'Change' : 'Add' }}
            </a>
            @if ($profile->languages)
                <a href="#" class="text-warning text-base" id="deleteLanguages"><i class="icon icon-trash"></i></a>
            @endif
        </h5>
        <div class="ml-4">
            @php
                echo $parse->text($profile->languages);
            @endphp
        </div>
    </section>
</div>
