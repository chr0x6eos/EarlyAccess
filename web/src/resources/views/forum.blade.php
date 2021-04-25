<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Forum') }}
        </h2>
    </x-slot>

    <!-- https://www.bootdey.com/snippets/view/bs4-forum#html -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Forum</h2></div>
                    <div class="panel-body">
                        <div class="main-body">
                            <div class="inner-wrapper">
                                <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div class="media forum-item">
                                                <div class="media-body">
                                                    <h6><a href="#" data-toggle="collapse" data-target=".forum-1" data-parent=".forum-content" class="text-body">Bug: Scoreboard showing errors</a></h6>
                                                    <p class="text-secondary">
                                                        Issue with scoreboard
                                                    </p>
                                                    <p class="text-muted"><a href="#">Support</a> replied <span class="text-secondary font-weight-bold">2 hours ago</span></p>
                                                </div>
                                                <div class="text-muted small text-center align-self-center">
                                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 8</span>
                                                    <span><i class="far fa-comment ml-2"></i> 2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div class="media forum-item">
                                                <div class="media-body">
                                                    <h6><a href="#" data-toggle="collapse" data-target=".forum-2" data-parent=".forum-content" class="text-body">Issue: Game-Key not working!</a></h6>
                                                    <p class="text-secondary">
                                                        My bought game-key does not work!
                                                    </p>
                                                    <p class="text-muted"><a href="#">Support</a> replied <span class="text-secondary font-weight-bold">10 hours ago</span></p>
                                                </div>
                                                <div class="text-muted small text-center align-self-center">
                                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 137</span>
                                                    <span><i class="far fa-comment ml-2"></i> 2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div class="media forum-item">
                                                <div class="media-body">
                                                    <h6><a href="#" data-toggle="collapse" data-target=".forum-3" data-parent=".forum-content" class="text-body">Game is unoptimized</a></h6>
                                                    <p class="text-secondary">
                                                        I want to refund my game!
                                                    </p>
                                                    <p class="text-muted"><a href="#">T04str</a> created this thread <span class="text-secondary font-weight-bold">2 days ago</span></p>
                                                </div>
                                                <div class="text-muted small text-center align-self-center">
                                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 153</span>
                                                    <span><i class="far fa-comment ml-2"></i> 1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body p-2 p-sm-3">
                                            <div class="media forum-item">
                                                <div class="media-body">
                                                    <h6><a href="#" data-toggle="collapse" data-target=".forum-4" data-parent=".forum-content" class="text-body">[RESOLVED] Bug: Game is crashing</a></h6>
                                                    <p class="text-secondary">
                                                        Game is crashing after score reaches 99!
                                                    </p>
                                                    <p class="text-muted"><a href="#">Support</a> replied <span class="text-secondary font-weight-bold">1 week ago</span></p>
                                                </div>
                                                <div class="text-muted small text-center align-self-center">
                                                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 186</span>
                                                    <span><i class="far fa-comment ml-2"></i> 4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="pagination pagination-sm pagination-circle justify-content-center mb-0">
                                        <li class="page-item active"><span class="page-link">1</span></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    </ul>
                                </div>

                                <div class="inner-main-body p-2 p-sm-3 collapse forum-1">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">SingleQuoteMan</a>
                                                    <small class="text-muted ml-2">3 hours ago</small>
                                                    <h5 class="mt-1">Bug: Scoreboard showing errors</h5>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hello Game-Corp Team!</p>
                                                        <p>
                                                            I have found a critical bug in the game-scoreboard.<br>My username (') returns strange errors on the scoreboard. Please fix this issue!
                                                        </p>
                                                        <p>Thanks, SingleQuoteMan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">Support</a>
                                                    <small class="text-muted ml-2">2 hours ago</small>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hey SingleQuoteMan,</p>
                                                        <p>
                                                            Thank you for reaching out to us.<br>
                                                            Our internal team has already added this to our Bug-Tracker and is currently working on resolving this issue permanently. For now, a temporary fix was issued that prevents creation of accounts with invalid usernames. (Your account is also affected by this change!)<br>
                                                            We are incredibly sorry for the inconvenience this has caused and will update you as soon as we have resolved this problem. Please feel welcome to reach out to us with any further questions you may as we would be more than happy to help.
                                                        </p>
                                                        <p>Take care, your Support-Team</p>
                                                    </div>
                                                    <button class="btn btn-xs text-muted has-icon"><i class="fa fa-heart" aria-hidden="true"></i>1</button>
                                                    <p class="text-muted small"><a href="#" class="text-muted small">Reply</a> (Only available to Alpha-Access users)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner-main-body p-2 p-sm-3 collapse forum-2">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">3lit3H4kr</a>
                                                    <small class="text-muted ml-2">16 hours ago</small>
                                                    <h5 class="mt-1">Issue: Game-Key not working!</h5>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Help!</p>
                                                        <p>
                                                            I have recently bought an Early Access Game-Key from your store, however now that I am trying to register the key to my account I keep getting errors.
                                                            This is the error I get:
                                                            "Game-key is invalid! If this issue persists, please contact the admin!"
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">Support</a>
                                                    <small class="text-muted ml-2">10 hours ago</small>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hello ,</p>
                                                        <p>
                                                            Thank you for reaching out to us.<br>
                                                            Due to the high load of traffic our Game-Key verification-API is currently experiencing issues. We are implementing a solution to fallback to manual verification by the support staff.<br>
                                                            Please use the contact form to privately contact an administrative user and send the Game-Key for manual verification.
                                                            We are incredibly sorry for the inconvenience this has caused you. We are doing our best to resolve this issue promptly.
                                                        </p>
                                                        <p>Take care, your Support-Team</p>
                                                    </div>
                                                    <button class="btn btn-xs text-muted has-icon"><i class="fa fa-heart" aria-hidden="true"></i>1</button>
                                                    <p class="text-muted small"><a href="#" class="text-muted small">Reply</a> (Only available to Alpha-Access users)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner-main-body p-2 p-sm-3 collapse forum-3">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">T04st3r</a>
                                                    <small class="text-muted ml-2">2 days ago</small>
                                                    <h5 class="mt-1">Issue: Game is unoptimized</h5>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>I demand a refund! </p>
                                                        <p>
                                                            The game is always lagging and I cannot get below score 3!<br>
                                                            How am I supposed to get top of the global leaderboard with that bad of a performance!!!!<br>
                                                            This is unacceptable!!!11!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner-main-body p-2 p-sm-3 collapse forum-4">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">TRyHArD</a>
                                                    <small class="text-muted ml-2">1 week ago</small>
                                                    <h5 class="mt-1">Bug: Game is crashing</h5>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hello dear development team,</p>
                                                        <p>
                                                            After a lot of training I finally managed to get a score of 999. But when I collected another point, the game crashed and all my progress was reset! All these hours are now lost...<br>
                                                            I ask for my progress to be restored.<br>
                                                        </p>
                                                        <p>Thank you so much!<br>TRyHArD</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">Support</a>
                                                    <small class="text-muted ml-2">1 week ago</small>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hi, TRyHArD</p>
                                                        <p>
                                                            Thank you for reaching out to us.<br>
                                                            We are incredibly sorry for the inconvenience this has caused.<br>
                                                            In order to further work on this issue, please send us your detailed user-information via our contact page.
                                                        </p>
                                                        <p>Take care, your Support-Team</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">TRyHArD</a>
                                                    <small class="text-muted ml-2">1 week ago</small>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hello again,</p>
                                                        <p>
                                                            As requested, I have submitted my user-details to you!<br>
                                                            I am looking forward to you reply
                                                        </p>
                                                        <p>TRyHArD</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    <a href="#" class="text-secondary">Support</a>
                                                    <small class="text-muted ml-2">1 week ago</small>
                                                    <div class="mt-3 font-size-sm">
                                                        <p>Hi, TRyHArD</p>
                                                        <p>
                                                            We have resolved the issue and restored you progress.<br>
                                                            Thank you for your patience.
                                                        </p>
                                                        <p>Take care, your Support-Team</p>
                                                    </div>
                                                    <button class="btn btn-xs text-muted has-icon"><i class="fa fa-heart" aria-hidden="true"></i>1</button>
                                                    <p class="text-muted small"><a href="#" class="text-muted small">Reply</a> (Only available to Alpha-Access users)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2 alert-success">
                                        <div class="card-body">
                                            <div class="media forum-item">
                                                <div class="media-body ml-3">
                                                    This conversation has been marked as resolved by the support staff.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

