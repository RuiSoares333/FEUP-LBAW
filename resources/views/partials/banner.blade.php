<nav id="side-nav" class="d-none d-lg-inline col-lg-3 col-xl-2">
    <div class="masthead">
        <div class="masthead-content text-center text-capitalize text-light">
            <h4 class="mt-4">super legit collaborative news</h4>
            <h5 class="">Followed Tags</h5>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </div>
    @if(Auth::check())
        <div id="tag-list-banner" class="row mx-auto p-3 justify-content-center">
            @each('partials.list_tag', Auth::user()->followed_tags(), 'tag')
        </div>
        
    @endif
        <div id="proposalcss1" class="col-10 mx-auto">
            <button id="proposal" class="col-12 btn fw-bold btn-primary rounded-pill py-2 text-light " onclick="toggleProposals()">Propose a New Tag</button>
        </div>

        <div id="tag_toggle" class="w-75 h-0 mx-auto d-none">
            <section id="prop_toggle" class="row justify-content-evenly">
                <input id="prop_name" type="text" placeholder="New Tag" autocomplete=off class="form-control col-12 mb-2" >
                <button id="proposal_cancel" class="col-5 btn btn-primary rounded-pill py-2 text-light d-none" onclick="toggleProposals()">Cancel</button>
                <button id="proposal_submit" class="col-5 btn btn-primary rounded-pill py-2 text-light" onclick="sendProposal()">Submit</button>
            </section>
        </div>


    <a href="{{ url('rte') }}" id="banner-rte" class="col-10 btn btn-primary rounded-pill border-0 py-2 px-4 text-light ">Share Your Story</button></a>
    <a href="{{ url('about_us') }}" id="banner-aboutus">About Us</a>
</nav>

<script>
    function toggleProposals(){
        const toggle = document.querySelector('#proposal')
        const cancel = document.querySelector('#proposal_cancel')
        const section = document.querySelector('#tag_toggle')
        const input = document.querySelector('#prop_name')

        toggle.classList.toggle('d-none')
        toggle.classList.toggle('h-0')
        cancel.classList.toggle('d-none')
        section.classList.toggle('d-none')
        section.classList.toggle('h-0')
        input.value = ""
    }

    async function sendProposal(){
        const input = document.querySelector('#prop_name')
        sendAjaxRequest('post', '/api/tag/propose', {'name':input.value})
        toggleProposals()
    }
</script>
