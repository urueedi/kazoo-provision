


<!DOCTYPE html>
<html lang="en" class="">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# object: http://ogp.me/ns/object# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="viewport" content="width=1020">
    
    
    <title>GS3/dial-log.php at master · amooma/GS3 · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png">
    <meta property="fb:app_id" content="1401488693436528">

      <meta content="@github" name="twitter:site" /><meta content="summary" name="twitter:card" /><meta content="amooma/GS3" name="twitter:title" /><meta content="GS3 - Dies ist die Asterisk Version von Gemeinschaft" name="twitter:description" /><meta content="https://avatars3.githubusercontent.com/u/67874?v=3&amp;s=400" name="twitter:image:src" />
      <meta content="GitHub" property="og:site_name" /><meta content="object" property="og:type" /><meta content="https://avatars3.githubusercontent.com/u/67874?v=3&amp;s=400" property="og:image" /><meta content="amooma/GS3" property="og:title" /><meta content="https://github.com/amooma/GS3" property="og:url" /><meta content="GS3 - Dies ist die Asterisk Version von Gemeinschaft" property="og:description" />
      <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">
    <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">
    <link rel="assets" href="https://assets-cdn.github.com/">
    
    <meta name="pjax-timeout" content="1000">
    

    <meta name="msapplication-TileImage" content="/windows-tile.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="selected-link" value="repo_source" data-pjax-transient>

        <meta name="google-analytics" content="UA-3769691-2">

    <meta content="collector.githubapp.com" name="octolytics-host" /><meta content="collector-cdn.github.com" name="octolytics-script-host" /><meta content="github" name="octolytics-app-id" /><meta content="BCA5FC15:5CC8:E7B718:55AE7CCC" name="octolytics-dimension-request_id" />
    
    <meta content="Rails, view, blob#show" data-pjax-transient="true" name="analytics-event" />
    <meta class="js-ga-set" name="dimension1" content="Logged Out">
    <meta name="is-dotcom" content="true">
      <meta name="hostname" content="github.com">
    <meta name="user-login" content="">

      <link rel="icon" sizes="any" mask href="https://assets-cdn.github.com/pinned-octocat.svg">
      <meta name="theme-color" content="#4078c0">
      <link rel="icon" type="image/x-icon" href="https://assets-cdn.github.com/favicon.ico">


    <meta content="authenticity_token" name="csrf-param" />
<meta content="FWnb4lMQ4GjrWmf3efSLv3dScmsbg0ROPR+BDFWt1kf8n2E90EbgbT2kAiPbMSxRBoai+6rW9f8Vs/zN7PKR0Q==" name="csrf-token" />

    <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/github/index-50695c5163ac470fa2c366bc981c3513f8feb7d6a55f8cb1c56501dc46585f0e.css" media="all" rel="stylesheet" />
    <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/github2/index-2e3e296b7bc97f7707cdaeccc73e6da4e5983f04f0f55b50c8064b5c3107cabc.css" media="all" rel="stylesheet" />
    
    


    <meta http-equiv="x-pjax-version" content="5f5fa14935d3921a7089959e4f51b5d2">

      
  <meta name="description" content="GS3 - Dies ist die Asterisk Version von Gemeinschaft">
  <meta name="go-import" content="github.com/amooma/GS3 git https://github.com/amooma/GS3.git">

  <meta content="67874" name="octolytics-dimension-user_id" /><meta content="amooma" name="octolytics-dimension-user_login" /><meta content="592854" name="octolytics-dimension-repository_id" /><meta content="amooma/GS3" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="592854" name="octolytics-dimension-repository_network_root_id" /><meta content="amooma/GS3" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/amooma/GS3/commits/master.atom" rel="alternate" title="Recent Commits to GS3:master" type="application/atom+xml">

  </head>


  <body class="logged_out  env-production  vis-public page-blob">
    <a href="#start-of-content" tabindex="1" class="accessibility-aid js-skip-to-content">Skip to content</a>
    <div class="wrapper">
      
      
      



        
        <div class="header header-logged-out" role="banner">
  <div class="container clearfix">

    <a class="header-logo-wordmark" href="https://github.com/" data-ga-click="(Logged out) Header, go to homepage, icon:logo-wordmark">
      <span class="mega-octicon octicon-logo-github"></span>
    </a>

    <div class="header-actions" role="navigation">
        <a class="btn btn-primary" href="/join" data-ga-click="(Logged out) Header, clicked Sign up, text:sign-up">Sign up</a>
      <a class="btn" href="/login?return_to=%2Famooma%2FGS3%2Fblob%2Fmaster%2Fopt%2Fgemeinschaft%2Fhtdocs%2Fprov%2Ftiptel%2Fdial-log.php" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Sign in</a>
    </div>

    <div class="site-search repo-scope js-site-search" role="search">
      <form accept-charset="UTF-8" action="/amooma/GS3/search" class="js-site-search-form" data-global-search-url="/search" data-repo-search-url="/amooma/GS3/search" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
  <label class="js-chromeless-input-container form-control">
    <div class="scope-badge">This repository</div>
    <input type="text"
      class="js-site-search-focus js-site-search-field is-clearable chromeless-input"
      data-hotkey="s"
      name="q"
      placeholder="Search"
      data-global-scope-placeholder="Search GitHub"
      data-repo-scope-placeholder="Search"
      tabindex="1"
      autocapitalize="off">
  </label>
</form>
    </div>

      <ul class="header-nav left" role="navigation">
          <li class="header-nav-item">
            <a class="header-nav-link" href="/explore" data-ga-click="(Logged out) Header, go to explore, text:explore">Explore</a>
          </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="/features" data-ga-click="(Logged out) Header, go to features, text:features">Features</a>
          </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="https://enterprise.github.com/" data-ga-click="(Logged out) Header, go to enterprise, text:enterprise">Enterprise</a>
          </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="/blog" data-ga-click="(Logged out) Header, go to blog, text:blog">Blog</a>
          </li>
      </ul>

  </div>
</div>



      <div id="start-of-content" class="accessibility-aid"></div>
          <div class="site" itemscope itemtype="http://schema.org/WebPage">
    <div id="js-flash-container">
      
    </div>
    <div class="pagehead repohead instapaper_ignore readability-menu">
      <div class="container">

        
<ul class="pagehead-actions">

  <li>
      <a href="/login?return_to=%2Famooma%2FGS3"
    class="btn btn-sm btn-with-count tooltipped tooltipped-n"
    aria-label="You must be signed in to watch a repository" rel="nofollow">
    <span class="octicon octicon-eye"></span>
    Watch
  </a>
  <a class="social-count" href="/amooma/GS3/watchers">
    7
  </a>

  </li>

  <li>
      <a href="/login?return_to=%2Famooma%2FGS3"
    class="btn btn-sm btn-with-count tooltipped tooltipped-n"
    aria-label="You must be signed in to star a repository" rel="nofollow">
    <span class="octicon octicon-star"></span>
    Star
  </a>

    <a class="social-count js-social-count" href="/amooma/GS3/stargazers">
      29
    </a>

  </li>

    <li>
      <a href="/login?return_to=%2Famooma%2FGS3"
        class="btn btn-sm btn-with-count tooltipped tooltipped-n"
        aria-label="You must be signed in to fork a repository" rel="nofollow">
        <span class="octicon octicon-repo-forked"></span>
        Fork
      </a>
      <a href="/amooma/GS3/network" class="social-count">
        27
      </a>
    </li>
</ul>

        <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
          <span class="mega-octicon octicon-repo"></span>
          <span class="author"><a href="/amooma" class="url fn" itemprop="url" rel="author"><span itemprop="title">amooma</span></a></span><!--
       --><span class="path-divider">/</span><!--
       --><strong><a href="/amooma/GS3" data-pjax="#js-repo-pjax-container">GS3</a></strong>

          <span class="page-context-loader">
            <img alt="" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
          </span>

        </h1>
      </div><!-- /.container -->
    </div><!-- /.repohead -->

    <div class="container">
      <div class="repository-with-sidebar repo-container new-discussion-timeline  ">
        <div class="repository-sidebar clearfix">
            
<nav class="sunken-menu repo-nav js-repo-nav js-sidenav-container-pjax js-octicon-loaders"
     role="navigation"
     data-pjax="#js-repo-pjax-container"
     data-issue-count-url="/amooma/GS3/issues/counts">
  <ul class="sunken-menu-group">
    <li class="tooltipped tooltipped-w" aria-label="Code">
      <a href="/amooma/GS3" aria-label="Code" aria-selected="true" class="js-selected-navigation-item selected sunken-menu-item" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches /amooma/GS3">
        <span class="octicon octicon-code"></span> <span class="full-word">Code</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

      <li class="tooltipped tooltipped-w" aria-label="Issues">
        <a href="/amooma/GS3/issues" aria-label="Issues" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g i" data-selected-links="repo_issues repo_labels repo_milestones /amooma/GS3/issues">
          <span class="octicon octicon-issue-opened"></span> <span class="full-word">Issues</span>
          <span class="js-issue-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

    <li class="tooltipped tooltipped-w" aria-label="Pull requests">
      <a href="/amooma/GS3/pulls" aria-label="Pull requests" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g p" data-selected-links="repo_pulls /amooma/GS3/pulls">
          <span class="octicon octicon-git-pull-request"></span> <span class="full-word">Pull requests</span>
          <span class="js-pull-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

      <li class="tooltipped tooltipped-w" aria-label="Wiki">
        <a href="/amooma/GS3/wiki" aria-label="Wiki" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g w" data-selected-links="repo_wiki /amooma/GS3/wiki">
          <span class="octicon octicon-book"></span> <span class="full-word">Wiki</span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>
  </ul>
  <div class="sunken-menu-separator"></div>
  <ul class="sunken-menu-group">

    <li class="tooltipped tooltipped-w" aria-label="Pulse">
      <a href="/amooma/GS3/pulse" aria-label="Pulse" class="js-selected-navigation-item sunken-menu-item" data-selected-links="pulse /amooma/GS3/pulse">
        <span class="octicon octicon-pulse"></span> <span class="full-word">Pulse</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

    <li class="tooltipped tooltipped-w" aria-label="Graphs">
      <a href="/amooma/GS3/graphs" aria-label="Graphs" class="js-selected-navigation-item sunken-menu-item" data-selected-links="repo_graphs repo_contributors /amooma/GS3/graphs">
        <span class="octicon octicon-graph"></span> <span class="full-word">Graphs</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>
  </ul>


</nav>

              <div class="only-with-full-nav">
                  
<div class="js-clone-url clone-url open"
  data-protocol-type="http">
  <h3><span class="text-emphasized">HTTPS</span> clone URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/amooma/GS3.git" readonly="readonly">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>

  
<div class="js-clone-url clone-url "
  data-protocol-type="subversion">
  <h3><span class="text-emphasized">Subversion</span> checkout URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/amooma/GS3" readonly="readonly">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>



<div class="clone-options">You can clone with
  <form accept-charset="UTF-8" action="/users/set_protocol?protocol_selector=http&amp;protocol_type=clone" class="inline-form js-clone-selector-form " data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="+a/4rWhKRBzJYr/17vvJFdm9KEDD1Vie+5m2wDz/7gu7euM+bViAJHxPmQbhJ1HL4jzOStOcFYX8fb+9fxWWRA==" /></div><button class="btn-link js-clone-selector" data-protocol="http" type="submit">HTTPS</button></form> or <form accept-charset="UTF-8" action="/users/set_protocol?protocol_selector=subversion&amp;protocol_type=clone" class="inline-form js-clone-selector-form " data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="QZXyVbjqfwq+OjvC50Eyg0PqIFyu/mlBTdP2M9Ed6y49G147b+DnijVNXFbFIqUlw3D9Sg3QiPVMFlVIlsw+HQ==" /></div><button class="btn-link js-clone-selector" data-protocol="subversion" type="submit">Subversion</button></form>.
  <a href="https://help.github.com/articles/which-remote-url-should-i-use" class="help tooltipped tooltipped-n" aria-label="Get help on which URL is right for you.">
    <span class="octicon octicon-question"></span>
  </a>
</div>




                <a href="/amooma/GS3/archive/master.zip"
                   class="btn btn-sm sidebar-button"
                   aria-label="Download the contents of amooma/GS3 as a zip file"
                   title="Download the contents of amooma/GS3 as a zip file"
                   rel="nofollow">
                  <span class="octicon octicon-cloud-download"></span>
                  Download ZIP
                </a>
              </div>
        </div><!-- /.repository-sidebar -->

        <div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container>

          

<a href="/amooma/GS3/blob/1758a494e9de2b380c636f87386b989ea683c277/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php" class="hidden js-permalink-shortcut" data-hotkey="y">Permalink</a>

<!-- blob contrib key: blob_contributors:v21:e8aa933e4933ab8c7270edd7c04940fa -->

<div class="file-navigation js-zeroclipboard-container">
  
<div class="select-menu js-menu-container js-select-menu left">
  <span class="btn btn-sm select-menu-button js-menu-target css-truncate" data-hotkey="w"
    data-ref="master"
    title="master"
    role="button" aria-label="Switch branches or tags" tabindex="0" aria-haspopup="true">
    <span class="octicon octicon-git-branch"></span>
    <i>branch:</i>
    <span class="js-select-button css-truncate-target">master</span>
  </span>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax aria-hidden="true">

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <span class="select-menu-title">Switch branches/tags</span>
        <span class="octicon octicon-x js-menu-close" role="button" aria-label="Close"></span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab" role="tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab" role="tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches" role="menu">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/1.8_testing/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="1.8_testing"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="1.8_testing">
                1.8_testing
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/3.0/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="3.0"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="3.0">
                3.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/3.1/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="3.1"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="3.1">
                3.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/3.2/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="3.2"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="3.2">
                3.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/3.2-RC/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="3.2-RC"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="3.2-RC">
                3.2-RC
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/amooma/GS3/blob/develop/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="develop"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="develop">
                develop
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/amooma/GS3/blob/master/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="master">
                master
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/amooma/GS3/tree/v3.0.0rc1/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
                 data-name="v3.0.0rc1"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text css-truncate-target"
                 title="v3.0.0rc1">v3.0.0rc1</a>
            </div>
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/amooma/GS3/tree/v3.0/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
                 data-name="v3.0"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text css-truncate-target"
                 title="v3.0">v3.0</a>
            </div>
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/amooma/GS3/tree/3.1-rc3/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
                 data-name="3.1-rc3"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text css-truncate-target"
                 title="3.1-rc3">3.1-rc3</a>
            </div>
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/amooma/GS3/tree/3.1-rc2/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
                 data-name="3.1-rc2"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text css-truncate-target"
                 title="3.1-rc2">3.1-rc2</a>
            </div>
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/amooma/GS3/tree/3.1-rc1/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php"
                 data-name="3.1-rc1"
                 data-skip-pjax="true"
                 rel="nofollow"
                 class="js-navigation-open select-menu-item-text css-truncate-target"
                 title="3.1-rc1">3.1-rc1</a>
            </div>
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>

  <div class="btn-group right">
    <a href="/amooma/GS3/find/master"
          class="js-show-file-finder btn btn-sm empty-icon tooltipped tooltipped-s"
          data-pjax
          data-hotkey="t"
          aria-label="Quickly jump between files">
      <span class="octicon octicon-list-unordered"></span>
    </a>
    <button aria-label="Copy file path to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
  </div>

  <div class="breadcrumb js-zeroclipboard-target">
    <span class="repo-root js-repo-root"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">GS3</span></a></span></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3/tree/master/opt" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">opt</span></a></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3/tree/master/opt/gemeinschaft" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">gemeinschaft</span></a></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3/tree/master/opt/gemeinschaft/htdocs" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">htdocs</span></a></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3/tree/master/opt/gemeinschaft/htdocs/prov" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">prov</span></a></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/amooma/GS3/tree/master/opt/gemeinschaft/htdocs/prov/tiptel" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">tiptel</span></a></span><span class="separator">/</span><strong class="final-path">dial-log.php</strong>
  </div>
</div>

<include-fragment class="commit commit-loader file-history-tease" src="/amooma/GS3/contributors/master/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php">
  <div class="file-history-tease-header">
    Fetching contributors&hellip;
  </div>

  <div class="participation">
    <p class="loader-loading"><img alt="" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32-EAF2F5.gif" width="16" /></p>
    <p class="loader-error">Cannot retrieve contributors at this time</p>
  </div>
</include-fragment>
<div class="file">
  <div class="file-header">
    <div class="file-actions">

      <div class="btn-group">
        <a href="/amooma/GS3/raw/master/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php" class="btn btn-sm " id="raw-url">Raw</a>
          <a href="/amooma/GS3/blame/master/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php" class="btn btn-sm js-update-url-with-hash">Blame</a>
        <a href="/amooma/GS3/commits/master/opt/gemeinschaft/htdocs/prov/tiptel/dial-log.php" class="btn btn-sm " rel="nofollow">History</a>
      </div>


          <button type="button" class="octicon-btn disabled tooltipped tooltipped-n" aria-label="You must be signed in to make or propose changes">
            <span class="octicon octicon-pencil"></span>
          </button>

        <button type="button" class="octicon-btn octicon-btn-danger disabled tooltipped tooltipped-n" aria-label="You must be signed in to make or propose changes">
          <span class="octicon octicon-trashcan"></span>
        </button>
    </div>

    <div class="file-info">
        241 lines (197 sloc)
        <span class="file-info-divider"></span>
      6.336 kB
    </div>
  </div>
  

  <div class="blob-wrapper data type-php">
      <table class="highlight tab-size js-file-line-container" data-tab-size="8">
      <tr>
        <td id="L1" class="blob-num js-line-number" data-line-number="1"></td>
        <td id="LC1" class="blob-code blob-code-inner js-file-line"><span class="pl-pse">&lt;?php</span><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L2" class="blob-num js-line-number" data-line-number="2"></td>
        <td id="LC2" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">/*******************************************************************\</span></span></td>
      </tr>
      <tr>
        <td id="L3" class="blob-num js-line-number" data-line-number="3"></td>
        <td id="LC3" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">*            Gemeinschaft - asterisk cluster gemeinschaft</span></span></td>
      </tr>
      <tr>
        <td id="L4" class="blob-num js-line-number" data-line-number="4"></td>
        <td id="LC4" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* </span></span></td>
      </tr>
      <tr>
        <td id="L5" class="blob-num js-line-number" data-line-number="5"></td>
        <td id="LC5" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* $Revision$</span></span></td>
      </tr>
      <tr>
        <td id="L6" class="blob-num js-line-number" data-line-number="6"></td>
        <td id="LC6" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* </span></span></td>
      </tr>
      <tr>
        <td id="L7" class="blob-num js-line-number" data-line-number="7"></td>
        <td id="LC7" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* Copyright 2010, amooma GmbH, Bachstr. 126, 56566 Neuwied, Germany,</span></span></td>
      </tr>
      <tr>
        <td id="L8" class="blob-num js-line-number" data-line-number="8"></td>
        <td id="LC8" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* http://www.amooma.de/</span></span></td>
      </tr>
      <tr>
        <td id="L9" class="blob-num js-line-number" data-line-number="9"></td>
        <td id="LC9" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* Sebastian Ertz &lt;gemeinschaft@swastel.eisfair.net&gt;</span></span></td>
      </tr>
      <tr>
        <td id="L10" class="blob-num js-line-number" data-line-number="10"></td>
        <td id="LC10" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* </span></span></td>
      </tr>
      <tr>
        <td id="L11" class="blob-num js-line-number" data-line-number="11"></td>
        <td id="LC11" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* This program is free software; you can redistribute it and/or</span></span></td>
      </tr>
      <tr>
        <td id="L12" class="blob-num js-line-number" data-line-number="12"></td>
        <td id="LC12" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* modify it under the terms of the GNU General Public License</span></span></td>
      </tr>
      <tr>
        <td id="L13" class="blob-num js-line-number" data-line-number="13"></td>
        <td id="LC13" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* as published by the Free Software Foundation; either version 2</span></span></td>
      </tr>
      <tr>
        <td id="L14" class="blob-num js-line-number" data-line-number="14"></td>
        <td id="LC14" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* of the License, or (at your option) any later version.</span></span></td>
      </tr>
      <tr>
        <td id="L15" class="blob-num js-line-number" data-line-number="15"></td>
        <td id="LC15" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* </span></span></td>
      </tr>
      <tr>
        <td id="L16" class="blob-num js-line-number" data-line-number="16"></td>
        <td id="LC16" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* This program is distributed in the hope that it will be useful,</span></span></td>
      </tr>
      <tr>
        <td id="L17" class="blob-num js-line-number" data-line-number="17"></td>
        <td id="LC17" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* but WITHOUT ANY WARRANTY; without even the implied warranty of</span></span></td>
      </tr>
      <tr>
        <td id="L18" class="blob-num js-line-number" data-line-number="18"></td>
        <td id="LC18" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the</span></span></td>
      </tr>
      <tr>
        <td id="L19" class="blob-num js-line-number" data-line-number="19"></td>
        <td id="LC19" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* GNU General Public License for more details.</span></span></td>
      </tr>
      <tr>
        <td id="L20" class="blob-num js-line-number" data-line-number="20"></td>
        <td id="LC20" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* </span></span></td>
      </tr>
      <tr>
        <td id="L21" class="blob-num js-line-number" data-line-number="21"></td>
        <td id="LC21" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* You should have received a copy of the GNU General Public License</span></span></td>
      </tr>
      <tr>
        <td id="L22" class="blob-num js-line-number" data-line-number="22"></td>
        <td id="LC22" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* along with this program; if not, write to the Free Software</span></span></td>
      </tr>
      <tr>
        <td id="L23" class="blob-num js-line-number" data-line-number="23"></td>
        <td id="LC23" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,</span></span></td>
      </tr>
      <tr>
        <td id="L24" class="blob-num js-line-number" data-line-number="24"></td>
        <td id="LC24" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">* MA 02110-1301, USA.</span></span></td>
      </tr>
      <tr>
        <td id="L25" class="blob-num js-line-number" data-line-number="25"></td>
        <td id="LC25" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">\*******************************************************************/</span></span></td>
      </tr>
      <tr>
        <td id="L26" class="blob-num js-line-number" data-line-number="26"></td>
        <td id="LC26" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L27" class="blob-num js-line-number" data-line-number="27"></td>
        <td id="LC27" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">define</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>GS_VALID<span class="pl-pds">&#39;</span></span>, <span class="pl-c1">true</span> );  <span class="pl-c">/// this is a parent file</span></span></td>
      </tr>
      <tr>
        <td id="L28" class="blob-num js-line-number" data-line-number="28"></td>
        <td id="LC28" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">require_once</span>( <span class="pl-c1">dirName</span>(<span class="pl-c1">__FILE__</span>) <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>/../../../inc/conf.php<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L29" class="blob-num js-line-number" data-line-number="29"></td>
        <td id="LC29" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">include_once</span>( <span class="pl-c1">GS_DIR</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>inc/db_connect.php<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L30" class="blob-num js-line-number" data-line-number="30"></td>
        <td id="LC30" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">include_once</span>( <span class="pl-c1">GS_DIR</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>inc/string.php<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L31" class="blob-num js-line-number" data-line-number="31"></td>
        <td id="LC31" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">include_once</span>( <span class="pl-c1">GS_DIR</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>inc/gettext.php<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L32" class="blob-num js-line-number" data-line-number="32"></td>
        <td id="LC32" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L33" class="blob-num js-line-number" data-line-number="33"></td>
        <td id="LC33" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Content-Type: application/xml; charset=utf-8<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L34" class="blob-num js-line-number" data-line-number="34"></td>
        <td id="LC34" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Expires: 0<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L35" class="blob-num js-line-number" data-line-number="35"></td>
        <td id="LC35" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Pragma: no-cache<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L36" class="blob-num js-line-number" data-line-number="36"></td>
        <td id="LC36" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Cache-Control: private, no-cache, must-revalidate<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L37" class="blob-num js-line-number" data-line-number="37"></td>
        <td id="LC37" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Vary: *<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L38" class="blob-num js-line-number" data-line-number="38"></td>
        <td id="LC38" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L39" class="blob-num js-line-number" data-line-number="39"></td>
        <td id="LC39" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">function</span> <span class="pl-en">tiptelXmlEsc</span>( <span class="pl-smi">$str</span> )</span></td>
      </tr>
      <tr>
        <td id="L40" class="blob-num js-line-number" data-line-number="40"></td>
        <td id="LC40" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">{</span></td>
      </tr>
      <tr>
        <td id="L41" class="blob-num js-line-number" data-line-number="41"></td>
        <td id="LC41" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">return</span> htmlEnt( <span class="pl-smi">$str</span> );</span></td>
      </tr>
      <tr>
        <td id="L42" class="blob-num js-line-number" data-line-number="42"></td>
        <td id="LC42" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L43" class="blob-num js-line-number" data-line-number="43"></td>
        <td id="LC43" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L44" class="blob-num js-line-number" data-line-number="44"></td>
        <td id="LC44" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">function</span> <span class="pl-en">_ob_send</span>()</span></td>
      </tr>
      <tr>
        <td id="L45" class="blob-num js-line-number" data-line-number="45"></td>
        <td id="LC45" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">{</span></td>
      </tr>
      <tr>
        <td id="L46" class="blob-num js-line-number" data-line-number="46"></td>
        <td id="LC46" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">if</span> (<span class="pl-k">!</span> <span class="pl-c1">headers_sent</span>()) {</span></td>
      </tr>
      <tr>
        <td id="L47" class="blob-num js-line-number" data-line-number="47"></td>
        <td id="LC47" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Content-Type: application/xml; charset=utf-8<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L48" class="blob-num js-line-number" data-line-number="48"></td>
        <td id="LC48" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">header</span>( <span class="pl-s"><span class="pl-pds">&#39;</span>Content-Length: <span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> (<span class="pl-k">int</span>)<span class="pl-k">@</span><span class="pl-c1">ob_get_length</span>() );</span></td>
      </tr>
      <tr>
        <td id="L49" class="blob-num js-line-number" data-line-number="49"></td>
        <td id="LC49" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	}</span></td>
      </tr>
      <tr>
        <td id="L50" class="blob-num js-line-number" data-line-number="50"></td>
        <td id="LC50" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">@</span><span class="pl-c1">ob_end_flush</span>();</span></td>
      </tr>
      <tr>
        <td id="L51" class="blob-num js-line-number" data-line-number="51"></td>
        <td id="LC51" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">die</span>();</span></td>
      </tr>
      <tr>
        <td id="L52" class="blob-num js-line-number" data-line-number="52"></td>
        <td id="LC52" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L53" class="blob-num js-line-number" data-line-number="53"></td>
        <td id="LC53" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L54" class="blob-num js-line-number" data-line-number="54"></td>
        <td id="LC54" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">function</span> <span class="pl-en">_err</span>( <span class="pl-smi">$msg</span><span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-pds">&#39;</span></span> )</span></td>
      </tr>
      <tr>
        <td id="L55" class="blob-num js-line-number" data-line-number="55"></td>
        <td id="LC55" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">{</span></td>
      </tr>
      <tr>
        <td id="L56" class="blob-num js-line-number" data-line-number="56"></td>
        <td id="LC56" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">@</span><span class="pl-c1">ob_end_clean</span>();</span></td>
      </tr>
      <tr>
        <td id="L57" class="blob-num js-line-number" data-line-number="57"></td>
        <td id="LC57" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">ob_start</span>();</span></td>
      </tr>
      <tr>
        <td id="L58" class="blob-num js-line-number" data-line-number="58"></td>
        <td id="LC58" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L59" class="blob-num js-line-number" data-line-number="59"></td>
        <td id="LC59" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L60" class="blob-num js-line-number" data-line-number="60"></td>
        <td id="LC60" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;TiptelIPPhoneTextScreen&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L61" class="blob-num js-line-number" data-line-number="61"></td>
        <td id="LC61" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Title&gt;<span class="pl-pds">&#39;</span></span>, __(<span class="pl-s"><span class="pl-pds">&#39;</span>Fehler<span class="pl-pds">&#39;</span></span>), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Title&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L62" class="blob-num js-line-number" data-line-number="62"></td>
        <td id="LC62" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Text&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( __(<span class="pl-s"><span class="pl-pds">&#39;</span>Fehler<span class="pl-pds">&#39;</span></span>) <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>: <span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$msg</span> ), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Text&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L63" class="blob-num js-line-number" data-line-number="63"></td>
        <td id="LC63" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/TiptelIPPhoneTextScreen&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L64" class="blob-num js-line-number" data-line-number="64"></td>
        <td id="LC64" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	_ob_send();</span></td>
      </tr>
      <tr>
        <td id="L65" class="blob-num js-line-number" data-line-number="65"></td>
        <td id="LC65" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L66" class="blob-num js-line-number" data-line-number="66"></td>
        <td id="LC66" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L67" class="blob-num js-line-number" data-line-number="67"></td>
        <td id="LC67" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L68" class="blob-num js-line-number" data-line-number="68"></td>
        <td id="LC68" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">if</span> (<span class="pl-k">!</span> gs_get_conf(<span class="pl-s"><span class="pl-pds">&#39;</span>GS_TIPTEL_PROV_ENABLED<span class="pl-pds">&#39;</span></span>)) {</span></td>
      </tr>
      <tr>
        <td id="L69" class="blob-num js-line-number" data-line-number="69"></td>
        <td id="LC69" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	gs_log( <span class="pl-c1">GS_LOG_DEBUG</span>, <span class="pl-s"><span class="pl-pds">&quot;</span>Tiptel provisioning not enabled<span class="pl-pds">&quot;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L70" class="blob-num js-line-number" data-line-number="70"></td>
        <td id="LC70" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	_err( <span class="pl-s"><span class="pl-pds">&#39;</span>Not enabled.<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L71" class="blob-num js-line-number" data-line-number="71"></td>
        <td id="LC71" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L72" class="blob-num js-line-number" data-line-number="72"></td>
        <td id="LC72" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L73" class="blob-num js-line-number" data-line-number="73"></td>
        <td id="LC73" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L74" class="blob-num js-line-number" data-line-number="74"></td>
        <td id="LC74" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$user</span> <span class="pl-k">=</span> <span class="pl-c1">trim</span>( <span class="pl-k">@</span> <span class="pl-smi">$_REQUEST</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>u<span class="pl-pds">&#39;</span></span>] );</span></td>
      </tr>
      <tr>
        <td id="L75" class="blob-num js-line-number" data-line-number="75"></td>
        <td id="LC75" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">if</span> (<span class="pl-k">!</span> <span class="pl-c1">preg_match</span>(<span class="pl-sr"><span class="pl-pds">&#39;/</span><span class="pl-k">^</span><span class="pl-cce">\d</span><span class="pl-k">+$</span><span class="pl-pds">/&#39;</span></span>, <span class="pl-smi">$user</span>))</span></td>
      </tr>
      <tr>
        <td id="L76" class="blob-num js-line-number" data-line-number="76"></td>
        <td id="LC76" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	_err( <span class="pl-s"><span class="pl-pds">&#39;</span>Not a valid SIP user.<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L77" class="blob-num js-line-number" data-line-number="77"></td>
        <td id="LC77" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$type</span> <span class="pl-k">=</span> <span class="pl-c1">trim</span>( <span class="pl-k">@</span> <span class="pl-smi">$_REQUEST</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>type<span class="pl-pds">&#39;</span></span>] );</span></td>
      </tr>
      <tr>
        <td id="L78" class="blob-num js-line-number" data-line-number="78"></td>
        <td id="LC78" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">if</span> (<span class="pl-k">!</span> <span class="pl-c1">in_array</span>( <span class="pl-smi">$type</span>, <span class="pl-c1">array</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>in<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>out<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>missed<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>queue<span class="pl-pds">&#39;</span></span>), <span class="pl-c1">true</span> ))</span></td>
      </tr>
      <tr>
        <td id="L79" class="blob-num js-line-number" data-line-number="79"></td>
        <td id="LC79" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-smi">$type</span> <span class="pl-k">=</span> <span class="pl-c1">false</span>;</span></td>
      </tr>
      <tr>
        <td id="L80" class="blob-num js-line-number" data-line-number="80"></td>
        <td id="LC80" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L81" class="blob-num js-line-number" data-line-number="81"></td>
        <td id="LC81" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L82" class="blob-num js-line-number" data-line-number="82"></td>
        <td id="LC82" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$db</span> <span class="pl-k">=</span> gs_db_slave_connect();</span></td>
      </tr>
      <tr>
        <td id="L83" class="blob-num js-line-number" data-line-number="83"></td>
        <td id="LC83" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L84" class="blob-num js-line-number" data-line-number="84"></td>
        <td id="LC84" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"># get user_id</span></span></td>
      </tr>
      <tr>
        <td id="L85" class="blob-num js-line-number" data-line-number="85"></td>
        <td id="LC85" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">#</span></span></td>
      </tr>
      <tr>
        <td id="L86" class="blob-num js-line-number" data-line-number="86"></td>
        <td id="LC86" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$user_id</span> <span class="pl-k">=</span> (<span class="pl-k">int</span>)<span class="pl-smi">$db</span><span class="pl-k">-&gt;</span>executeGetOne( <span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-s1"><span class="pl-k">SELECT</span> <span class="pl-s"><span class="pl-pds">`</span>_user_id<span class="pl-pds">`</span></span> <span class="pl-k">FROM</span> <span class="pl-s"><span class="pl-pds">`</span>ast_sipfriends<span class="pl-pds">`</span></span> <span class="pl-k">WHERE</span> <span class="pl-s"><span class="pl-pds">`</span>name<span class="pl-pds">`</span></span><span class="pl-k">=</span><span class="pl-cce">\&#39;</span></span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$db</span><span class="pl-k">-&gt;</span>escape(<span class="pl-smi">$user</span>) <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-cce">\&#39;</span><span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L87" class="blob-num js-line-number" data-line-number="87"></td>
        <td id="LC87" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">if</span> (<span class="pl-smi">$user_id</span> <span class="pl-k">&lt;</span> <span class="pl-c1">1</span>)</span></td>
      </tr>
      <tr>
        <td id="L88" class="blob-num js-line-number" data-line-number="88"></td>
        <td id="LC88" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	_err( <span class="pl-s"><span class="pl-pds">&#39;</span>Unknown user.<span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L89" class="blob-num js-line-number" data-line-number="89"></td>
        <td id="LC89" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L90" class="blob-num js-line-number" data-line-number="90"></td>
        <td id="LC90" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L91" class="blob-num js-line-number" data-line-number="91"></td>
        <td id="LC91" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$typeToTitle</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>(</span></td>
      </tr>
      <tr>
        <td id="L92" class="blob-num js-line-number" data-line-number="92"></td>
        <td id="LC92" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-s"><span class="pl-pds">&#39;</span>out<span class="pl-pds">&#39;</span></span>    <span class="pl-k">=&gt;</span> __(<span class="pl-s"><span class="pl-pds">&quot;</span>Gew<span class="pl-c1">\xC3\xA4</span>hlt<span class="pl-pds">&quot;</span></span>),</span></td>
      </tr>
      <tr>
        <td id="L93" class="blob-num js-line-number" data-line-number="93"></td>
        <td id="LC93" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-s"><span class="pl-pds">&#39;</span>missed<span class="pl-pds">&#39;</span></span> <span class="pl-k">=&gt;</span> __(<span class="pl-s"><span class="pl-pds">&quot;</span>Verpasst<span class="pl-pds">&quot;</span></span>),</span></td>
      </tr>
      <tr>
        <td id="L94" class="blob-num js-line-number" data-line-number="94"></td>
        <td id="LC94" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-s"><span class="pl-pds">&#39;</span>in<span class="pl-pds">&#39;</span></span>     <span class="pl-k">=&gt;</span> __(<span class="pl-s"><span class="pl-pds">&quot;</span>Angenommen<span class="pl-pds">&quot;</span></span>),</span></td>
      </tr>
      <tr>
        <td id="L95" class="blob-num js-line-number" data-line-number="95"></td>
        <td id="LC95" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-s"><span class="pl-pds">&#39;</span>queue<span class="pl-pds">&#39;</span></span>  <span class="pl-k">=&gt;</span> __(<span class="pl-s"><span class="pl-pds">&quot;</span>Warteschlangen<span class="pl-pds">&quot;</span></span>)</span></td>
      </tr>
      <tr>
        <td id="L96" class="blob-num js-line-number" data-line-number="96"></td>
        <td id="LC96" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">);</span></td>
      </tr>
      <tr>
        <td id="L97" class="blob-num js-line-number" data-line-number="97"></td>
        <td id="LC97" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L98" class="blob-num js-line-number" data-line-number="98"></td>
        <td id="LC98" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L99" class="blob-num js-line-number" data-line-number="99"></td>
        <td id="LC99" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L100" class="blob-num js-line-number" data-line-number="100"></td>
        <td id="LC100" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c1">ob_start</span>();</span></td>
      </tr>
      <tr>
        <td id="L101" class="blob-num js-line-number" data-line-number="101"></td>
        <td id="LC101" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L102" class="blob-num js-line-number" data-line-number="102"></td>
        <td id="LC102" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L103" class="blob-num js-line-number" data-line-number="103"></td>
        <td id="LC103" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-smi">$url_tiptel_dl</span> <span class="pl-k">=</span> <span class="pl-c1">GS_PROV_SCHEME</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>://<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-c1">GS_PROV_HOST</span> <span class="pl-k">.</span> (<span class="pl-c1">GS_PROV_PORT</span> ? <span class="pl-s"><span class="pl-pds">&#39;</span>:<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span><span class="pl-c1">GS_PROV_PORT</span> : <span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-pds">&#39;</span></span>) <span class="pl-k">.</span> <span class="pl-c1">GS_PROV_PATH</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>tiptel/dial-log.php<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L104" class="blob-num js-line-number" data-line-number="104"></td>
        <td id="LC104" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L105" class="blob-num js-line-number" data-line-number="105"></td>
        <td id="LC105" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L106" class="blob-num js-line-number" data-line-number="106"></td>
        <td id="LC106" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">#################################### INITIAL SCREEN {</span></span></td>
      </tr>
      <tr>
        <td id="L107" class="blob-num js-line-number" data-line-number="107"></td>
        <td id="LC107" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">if</span> (<span class="pl-k">!</span> <span class="pl-smi">$type</span>) {</span></td>
      </tr>
      <tr>
        <td id="L108" class="blob-num js-line-number" data-line-number="108"></td>
        <td id="LC108" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L109" class="blob-num js-line-number" data-line-number="109"></td>
        <td id="LC109" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c"># delete outdated entries</span></span></td>
      </tr>
      <tr>
        <td id="L110" class="blob-num js-line-number" data-line-number="110"></td>
        <td id="LC110" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c">#</span></span></td>
      </tr>
      <tr>
        <td id="L111" class="blob-num js-line-number" data-line-number="111"></td>
        <td id="LC111" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-smi">$db</span><span class="pl-k">-&gt;</span>execute( <span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-s1"><span class="pl-k">DELETE</span> <span class="pl-k">FROM</span> <span class="pl-s"><span class="pl-pds">`</span>dial_log<span class="pl-pds">`</span></span> <span class="pl-k">WHERE</span> <span class="pl-s"><span class="pl-pds">`</span>user_id<span class="pl-pds">`</span></span><span class="pl-k">=</span></span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$user_id</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span> AND `timestamp`&lt;<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> (<span class="pl-c1">time</span>()<span class="pl-k">-</span>(<span class="pl-k">int</span>)<span class="pl-c1">GS_PROV_DIAL_LOG_LIFE</span>) );</span></td>
      </tr>
      <tr>
        <td id="L112" class="blob-num js-line-number" data-line-number="112"></td>
        <td id="LC112" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L113" class="blob-num js-line-number" data-line-number="113"></td>
        <td id="LC113" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L114" class="blob-num js-line-number" data-line-number="114"></td>
        <td id="LC114" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L115" class="blob-num js-line-number" data-line-number="115"></td>
        <td id="LC115" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">echo</span> <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L116" class="blob-num js-line-number" data-line-number="116"></td>
        <td id="LC116" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L117" class="blob-num js-line-number" data-line-number="117"></td>
        <td id="LC117" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;TiptelIPPhoneTextMenu&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L118" class="blob-num js-line-number" data-line-number="118"></td>
        <td id="LC118" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Title&gt;<span class="pl-pds">&#39;</span></span>, __(<span class="pl-s"><span class="pl-pds">&#39;</span>Anruflisten<span class="pl-pds">&#39;</span></span>) ,<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Title&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L119" class="blob-num js-line-number" data-line-number="119"></td>
        <td id="LC119" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L120" class="blob-num js-line-number" data-line-number="120"></td>
        <td id="LC120" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">foreach</span> (<span class="pl-smi">$typeToTitle</span> <span class="pl-k">as</span> <span class="pl-smi">$t</span> <span class="pl-k">=&gt;</span> <span class="pl-smi">$title</span>) {</span></td>
      </tr>
      <tr>
        <td id="L121" class="blob-num js-line-number" data-line-number="121"></td>
        <td id="LC121" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		</span></td>
      </tr>
      <tr>
        <td id="L122" class="blob-num js-line-number" data-line-number="122"></td>
        <td id="LC122" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-smi">$num_calls</span> <span class="pl-k">=</span> (<span class="pl-k">int</span>)<span class="pl-smi">$db</span><span class="pl-k">-&gt;</span>executeGetOne( <span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-s1"><span class="pl-k">SELECT</span> <span class="pl-c1">COUNT</span>(<span class="pl-k">*</span>) <span class="pl-k">FROM</span> <span class="pl-s"><span class="pl-pds">`</span>dial_log<span class="pl-pds">`</span></span> <span class="pl-k">WHERE</span> <span class="pl-s"><span class="pl-pds">`</span>user_id<span class="pl-pds">`</span></span><span class="pl-k">=</span></span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$user_id</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span> AND `type`=<span class="pl-cce">\&#39;</span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$t</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-cce">\&#39;</span><span class="pl-pds">&#39;</span></span> );</span></td>
      </tr>
      <tr>
        <td id="L123" class="blob-num js-line-number" data-line-number="123"></td>
        <td id="LC123" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c">//if ($num_calls &gt; 0) {</span></span></td>
      </tr>
      <tr>
        <td id="L124" class="blob-num js-line-number" data-line-number="124"></td>
        <td id="LC124" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L125" class="blob-num js-line-number" data-line-number="125"></td>
        <td id="LC125" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L126" class="blob-num js-line-number" data-line-number="126"></td>
        <td id="LC126" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;MenuItem&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L127" class="blob-num js-line-number" data-line-number="127"></td>
        <td id="LC127" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">					<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Prompt&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( <span class="pl-smi">$title</span> ) ,<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Prompt&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L128" class="blob-num js-line-number" data-line-number="128"></td>
        <td id="LC128" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">					<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-smi">$url_tiptel_dl</span> , <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L129" class="blob-num js-line-number" data-line-number="129"></td>
        <td id="LC129" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">					<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Selection&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc(<span class="pl-s"><span class="pl-pds">&#39;</span>0&amp;u=<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span><span class="pl-smi">$user</span><span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>&amp;type=<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span><span class="pl-smi">$t</span>), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Selection&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L130" class="blob-num js-line-number" data-line-number="130"></td>
        <td id="LC130" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/MenuItem&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L131" class="blob-num js-line-number" data-line-number="131"></td>
        <td id="LC131" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c">//}</span></span></td>
      </tr>
      <tr>
        <td id="L132" class="blob-num js-line-number" data-line-number="132"></td>
        <td id="LC132" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	}</span></td>
      </tr>
      <tr>
        <td id="L133" class="blob-num js-line-number" data-line-number="133"></td>
        <td id="LC133" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L134" class="blob-num js-line-number" data-line-number="134"></td>
        <td id="LC134" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L135" class="blob-num js-line-number" data-line-number="135"></td>
        <td id="LC135" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L136" class="blob-num js-line-number" data-line-number="136"></td>
        <td id="LC136" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/TiptelIPPhoneTextMenu&gt;<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L137" class="blob-num js-line-number" data-line-number="137"></td>
        <td id="LC137" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L138" class="blob-num js-line-number" data-line-number="138"></td>
        <td id="LC138" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L139" class="blob-num js-line-number" data-line-number="139"></td>
        <td id="LC139" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">#################################### INITIAL SCREEN }</span></span></td>
      </tr>
      <tr>
        <td id="L140" class="blob-num js-line-number" data-line-number="140"></td>
        <td id="LC140" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L141" class="blob-num js-line-number" data-line-number="141"></td>
        <td id="LC141" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L142" class="blob-num js-line-number" data-line-number="142"></td>
        <td id="LC142" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L143" class="blob-num js-line-number" data-line-number="143"></td>
        <td id="LC143" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">#################################### DIAL LOG {</span></span></td>
      </tr>
      <tr>
        <td id="L144" class="blob-num js-line-number" data-line-number="144"></td>
        <td id="LC144" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">else</span> {</span></td>
      </tr>
      <tr>
        <td id="L145" class="blob-num js-line-number" data-line-number="145"></td>
        <td id="LC145" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L146" class="blob-num js-line-number" data-line-number="146"></td>
        <td id="LC146" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-c1">echo</span> <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?<span class="pl-pds">&#39;</span></span>,<span class="pl-s"><span class="pl-pds">&#39;</span>&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L147" class="blob-num js-line-number" data-line-number="147"></td>
        <td id="LC147" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">if</span> ( <span class="pl-smi">$type</span> <span class="pl-k">===</span> <span class="pl-s"><span class="pl-pds">&#39;</span>queue<span class="pl-pds">&#39;</span></span> ){	</span></td>
      </tr>
      <tr>
        <td id="L148" class="blob-num js-line-number" data-line-number="148"></td>
        <td id="LC148" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-smi">$query</span> <span class="pl-k">=</span></span></td>
      </tr>
      <tr>
        <td id="L149" class="blob-num js-line-number" data-line-number="149"></td>
        <td id="LC149" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-s1"><span class="pl-k">SELECT</span></span></span></span></td>
      </tr>
      <tr>
        <td id="L150" class="blob-num js-line-number" data-line-number="150"></td>
        <td id="LC150" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">`</span>timestamp<span class="pl-pds">`</span></span> <span class="pl-s"><span class="pl-pds">`</span>ts<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>number<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>remote_name<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>remote_user_id<span class="pl-pds">`</span></span>,</span></span></span></td>
      </tr>
      <tr>
        <td id="L151" class="blob-num js-line-number" data-line-number="151"></td>
        <td id="LC151" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		 <span class="pl-c1">1</span> <span class="pl-s"><span class="pl-pds">`</span>num_calls<span class="pl-pds">`</span></span></span></span></span></td>
      </tr>
      <tr>
        <td id="L152" class="blob-num js-line-number" data-line-number="152"></td>
        <td id="LC152" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		<span class="pl-k">FROM</span> <span class="pl-s"><span class="pl-pds">`</span>dial_log<span class="pl-pds">`</span></span></span></span></span></td>
      </tr>
      <tr>
        <td id="L153" class="blob-num js-line-number" data-line-number="153"></td>
        <td id="LC153" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		<span class="pl-k">WHERE</span></span></span></span></td>
      </tr>
      <tr>
        <td id="L154" class="blob-num js-line-number" data-line-number="154"></td>
        <td id="LC154" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">`</span>user_id<span class="pl-pds">`</span></span><span class="pl-k">=</span></span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$user_id</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span> AND</span></span></td>
      </tr>
      <tr>
        <td id="L155" class="blob-num js-line-number" data-line-number="155"></td>
        <td id="LC155" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">			`type`=<span class="pl-cce">\&#39;</span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$type</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-cce">\&#39;</span></span></span></td>
      </tr>
      <tr>
        <td id="L156" class="blob-num js-line-number" data-line-number="156"></td>
        <td id="LC156" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">		ORDER BY `ts` DESC</span></span></td>
      </tr>
      <tr>
        <td id="L157" class="blob-num js-line-number" data-line-number="157"></td>
        <td id="LC157" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">		LIMIT 15<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L158" class="blob-num js-line-number" data-line-number="158"></td>
        <td id="LC158" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	} <span class="pl-k">else</span> {</span></td>
      </tr>
      <tr>
        <td id="L159" class="blob-num js-line-number" data-line-number="159"></td>
        <td id="LC159" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-smi">$query</span> <span class="pl-k">=</span></span></td>
      </tr>
      <tr>
        <td id="L160" class="blob-num js-line-number" data-line-number="160"></td>
        <td id="LC160" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-s1"><span class="pl-k">SELECT</span></span></span></span></td>
      </tr>
      <tr>
        <td id="L161" class="blob-num js-line-number" data-line-number="161"></td>
        <td id="LC161" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">			<span class="pl-c1">MAX</span>(<span class="pl-s"><span class="pl-pds">`</span>timestamp<span class="pl-pds">`</span></span>) <span class="pl-s"><span class="pl-pds">`</span>ts<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>number<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>remote_name<span class="pl-pds">`</span></span>, <span class="pl-s"><span class="pl-pds">`</span>remote_user_id<span class="pl-pds">`</span></span>,</span></span></span></td>
      </tr>
      <tr>
        <td id="L162" class="blob-num js-line-number" data-line-number="162"></td>
        <td id="LC162" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		<span class="pl-c1">COUNT</span>(<span class="pl-k">*</span>) <span class="pl-s"><span class="pl-pds">`</span>num_calls<span class="pl-pds">`</span></span></span></span></span></td>
      </tr>
      <tr>
        <td id="L163" class="blob-num js-line-number" data-line-number="163"></td>
        <td id="LC163" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		<span class="pl-k">FROM</span> <span class="pl-s"><span class="pl-pds">`</span>dial_log<span class="pl-pds">`</span></span></span></span></span></td>
      </tr>
      <tr>
        <td id="L164" class="blob-num js-line-number" data-line-number="164"></td>
        <td id="LC164" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">		<span class="pl-k">WHERE</span></span></span></span></td>
      </tr>
      <tr>
        <td id="L165" class="blob-num js-line-number" data-line-number="165"></td>
        <td id="LC165" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">`</span>user_id<span class="pl-pds">`</span></span><span class="pl-k">=</span></span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$user_id</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span> AND</span></span></td>
      </tr>
      <tr>
        <td id="L166" class="blob-num js-line-number" data-line-number="166"></td>
        <td id="LC166" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">			`type`=<span class="pl-cce">\&#39;</span><span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$type</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-cce">\&#39;</span></span></span></td>
      </tr>
      <tr>
        <td id="L167" class="blob-num js-line-number" data-line-number="167"></td>
        <td id="LC167" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">		GROUP BY `number`</span></span></td>
      </tr>
      <tr>
        <td id="L168" class="blob-num js-line-number" data-line-number="168"></td>
        <td id="LC168" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">		ORDER BY `ts` DESC</span></span></td>
      </tr>
      <tr>
        <td id="L169" class="blob-num js-line-number" data-line-number="169"></td>
        <td id="LC169" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-s">		LIMIT 15<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L170" class="blob-num js-line-number" data-line-number="170"></td>
        <td id="LC170" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	}</span></td>
      </tr>
      <tr>
        <td id="L171" class="blob-num js-line-number" data-line-number="171"></td>
        <td id="LC171" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-smi">$rs</span> <span class="pl-k">=</span> <span class="pl-smi">$db</span><span class="pl-k">-&gt;</span>execute( <span class="pl-smi">$query</span> );</span></td>
      </tr>
      <tr>
        <td id="L172" class="blob-num js-line-number" data-line-number="172"></td>
        <td id="LC172" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L173" class="blob-num js-line-number" data-line-number="173"></td>
        <td id="LC173" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	<span class="pl-k">if</span> (<span class="pl-smi">$rs</span><span class="pl-k">-&gt;</span>numRows() <span class="pl-k">&gt;</span> <span class="pl-c1">0</span>) {</span></td>
      </tr>
      <tr>
        <td id="L174" class="blob-num js-line-number" data-line-number="174"></td>
        <td id="LC174" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L175" class="blob-num js-line-number" data-line-number="175"></td>
        <td id="LC175" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;TiptelIPPhoneDirectory style=&quot;radio&quot;&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L176" class="blob-num js-line-number" data-line-number="176"></td>
        <td id="LC176" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Title&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( <span class="pl-smi">$typeToTitle</span>[<span class="pl-smi">$type</span>]), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Title&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L177" class="blob-num js-line-number" data-line-number="177"></td>
        <td id="LC177" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		</span></td>
      </tr>
      <tr>
        <td id="L178" class="blob-num js-line-number" data-line-number="178"></td>
        <td id="LC178" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-k">while</span> (<span class="pl-smi">$r</span> <span class="pl-k">=</span> <span class="pl-smi">$rs</span><span class="pl-k">-&gt;</span>fetchRow()) {</span></td>
      </tr>
      <tr>
        <td id="L179" class="blob-num js-line-number" data-line-number="179"></td>
        <td id="LC179" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			</span></td>
      </tr>
      <tr>
        <td id="L180" class="blob-num js-line-number" data-line-number="180"></td>
        <td id="LC180" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-smi">$entry_name</span> <span class="pl-k">=</span> <span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>number<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L181" class="blob-num js-line-number" data-line-number="181"></td>
        <td id="LC181" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-k">if</span> (<span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>remote_name<span class="pl-pds">&#39;</span></span>] <span class="pl-k">!</span><span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">&#39;</span><span class="pl-pds">&#39;</span></span>) {</span></td>
      </tr>
      <tr>
        <td id="L182" class="blob-num js-line-number" data-line-number="182"></td>
        <td id="LC182" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-smi">$entry_name</span> <span class="pl-k">.=</span> <span class="pl-s"><span class="pl-pds">&#39;</span> <span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>remote_name<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L183" class="blob-num js-line-number" data-line-number="183"></td>
        <td id="LC183" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			}</span></td>
      </tr>
      <tr>
        <td id="L184" class="blob-num js-line-number" data-line-number="184"></td>
        <td id="LC184" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-k">if</span> (<span class="pl-c1">date</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>dm<span class="pl-pds">&#39;</span></span>) <span class="pl-k">==</span> <span class="pl-c1">date</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>dm<span class="pl-pds">&#39;</span></span>, (<span class="pl-k">int</span>)<span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>ts<span class="pl-pds">&#39;</span></span>]))</span></td>
      </tr>
      <tr>
        <td id="L185" class="blob-num js-line-number" data-line-number="185"></td>
        <td id="LC185" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-smi">$when</span> <span class="pl-k">=</span> <span class="pl-c1">date</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>H:i<span class="pl-pds">&#39;</span></span>, (<span class="pl-k">int</span>)<span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>ts<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L186" class="blob-num js-line-number" data-line-number="186"></td>
        <td id="LC186" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-k">else</span></span></td>
      </tr>
      <tr>
        <td id="L187" class="blob-num js-line-number" data-line-number="187"></td>
        <td id="LC187" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-smi">$when</span> <span class="pl-k">=</span> <span class="pl-c1">date</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>d.m.<span class="pl-pds">&#39;</span></span>, (<span class="pl-k">int</span>)<span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>ts<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L188" class="blob-num js-line-number" data-line-number="188"></td>
        <td id="LC188" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-smi">$entry_name</span> <span class="pl-k">=</span> <span class="pl-smi">$when</span> <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>  <span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$entry_name</span>;</span></td>
      </tr>
      <tr>
        <td id="L189" class="blob-num js-line-number" data-line-number="189"></td>
        <td id="LC189" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-k">if</span> (<span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>num_calls<span class="pl-pds">&#39;</span></span>] <span class="pl-k">&gt;</span> <span class="pl-c1">1</span>) {</span></td>
      </tr>
      <tr>
        <td id="L190" class="blob-num js-line-number" data-line-number="190"></td>
        <td id="LC190" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-smi">$entry_name</span> <span class="pl-k">.=</span> <span class="pl-s"><span class="pl-pds">&#39;</span> (<span class="pl-pds">&#39;</span></span><span class="pl-k">.</span> <span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>num_calls<span class="pl-pds">&#39;</span></span>] <span class="pl-k">.</span><span class="pl-s"><span class="pl-pds">&#39;</span>)<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L191" class="blob-num js-line-number" data-line-number="191"></td>
        <td id="LC191" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			}</span></td>
      </tr>
      <tr>
        <td id="L192" class="blob-num js-line-number" data-line-number="192"></td>
        <td id="LC192" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L193" class="blob-num js-line-number" data-line-number="193"></td>
        <td id="LC193" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L194" class="blob-num js-line-number" data-line-number="194"></td>
        <td id="LC194" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;MenuItem&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L195" class="blob-num js-line-number" data-line-number="195"></td>
        <td id="LC195" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">					<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Prompt&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( <span class="pl-smi">$entry_name</span> ) ,<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Prompt&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L196" class="blob-num js-line-number" data-line-number="196"></td>
        <td id="LC196" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">					<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( <span class="pl-smi">$r</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>number<span class="pl-pds">&#39;</span></span>] ) ,<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L197" class="blob-num js-line-number" data-line-number="197"></td>
        <td id="LC197" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/MenuItem&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L198" class="blob-num js-line-number" data-line-number="198"></td>
        <td id="LC198" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			</span></td>
      </tr>
      <tr>
        <td id="L199" class="blob-num js-line-number" data-line-number="199"></td>
        <td id="LC199" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		}</span></td>
      </tr>
      <tr>
        <td id="L200" class="blob-num js-line-number" data-line-number="200"></td>
        <td id="LC200" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		</span></td>
      </tr>
      <tr>
        <td id="L201" class="blob-num js-line-number" data-line-number="201"></td>
        <td id="LC201" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L202" class="blob-num js-line-number" data-line-number="202"></td>
        <td id="LC202" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L203" class="blob-num js-line-number" data-line-number="203"></td>
        <td id="LC203" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;SoftKey index=&quot;1&quot;&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L204" class="blob-num js-line-number" data-line-number="204"></td>
        <td id="LC204" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Label&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc(__(<span class="pl-s"><span class="pl-pds">&quot;</span>Zur<span class="pl-c1">\xC3\xBC</span>ck<span class="pl-pds">&quot;</span></span>)), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Label&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L205" class="blob-num js-line-number" data-line-number="205"></td>
        <td id="LC205" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;SoftKey:Exit&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L206" class="blob-num js-line-number" data-line-number="206"></td>
        <td id="LC206" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/SoftKey&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L207" class="blob-num js-line-number" data-line-number="207"></td>
        <td id="LC207" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L208" class="blob-num js-line-number" data-line-number="208"></td>
        <td id="LC208" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;SoftKey index=&quot;2&quot;&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L209" class="blob-num js-line-number" data-line-number="209"></td>
        <td id="LC209" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Label&gt;&lt;/Label&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L210" class="blob-num js-line-number" data-line-number="210"></td>
        <td id="LC210" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L211" class="blob-num js-line-number" data-line-number="211"></td>
        <td id="LC211" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/SoftKey&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L212" class="blob-num js-line-number" data-line-number="212"></td>
        <td id="LC212" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L213" class="blob-num js-line-number" data-line-number="213"></td>
        <td id="LC213" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;SoftKey index=&quot;3&quot;&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L214" class="blob-num js-line-number" data-line-number="214"></td>
        <td id="LC214" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Label&gt;&lt;/Label&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L215" class="blob-num js-line-number" data-line-number="215"></td>
        <td id="LC215" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L216" class="blob-num js-line-number" data-line-number="216"></td>
        <td id="LC216" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/SoftKey&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L217" class="blob-num js-line-number" data-line-number="217"></td>
        <td id="LC217" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L218" class="blob-num js-line-number" data-line-number="218"></td>
        <td id="LC218" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;SoftKey index=&quot;4&quot;&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L219" class="blob-num js-line-number" data-line-number="219"></td>
        <td id="LC219" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Label&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc(__(<span class="pl-s"><span class="pl-pds">&quot;</span>W<span class="pl-c1">\xC3\xA4</span>hlen<span class="pl-pds">&quot;</span></span>)), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Label&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L220" class="blob-num js-line-number" data-line-number="220"></td>
        <td id="LC220" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;URI&gt;SoftKey:Dial&lt;/URI&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L221" class="blob-num js-line-number" data-line-number="221"></td>
        <td id="LC221" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/SoftKey&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L222" class="blob-num js-line-number" data-line-number="222"></td>
        <td id="LC222" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		</span></td>
      </tr>
      <tr>
        <td id="L223" class="blob-num js-line-number" data-line-number="223"></td>
        <td id="LC223" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L224" class="blob-num js-line-number" data-line-number="224"></td>
        <td id="LC224" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L225" class="blob-num js-line-number" data-line-number="225"></td>
        <td id="LC225" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/TiptelIPPhoneDirectory&gt;<span class="pl-pds">&#39;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L226" class="blob-num js-line-number" data-line-number="226"></td>
        <td id="LC226" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	} <span class="pl-k">else</span> {</span></td>
      </tr>
      <tr>
        <td id="L227" class="blob-num js-line-number" data-line-number="227"></td>
        <td id="LC227" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">		<span class="pl-c1">echo</span></span></td>
      </tr>
      <tr>
        <td id="L228" class="blob-num js-line-number" data-line-number="228"></td>
        <td id="LC228" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;TiptelIPPhoneTextScreen&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L229" class="blob-num js-line-number" data-line-number="229"></td>
        <td id="LC229" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Title&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc( <span class="pl-smi">$typeToTitle</span>[<span class="pl-smi">$type</span>] ), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Title&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L230" class="blob-num js-line-number" data-line-number="230"></td>
        <td id="LC230" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">				<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;Text&gt;<span class="pl-pds">&#39;</span></span>, tiptelXmlEsc(__(<span class="pl-s"><span class="pl-pds">&quot;</span>Keine Eintr<span class="pl-c1">\xC3\xA4</span>ge<span class="pl-pds">&quot;</span></span>)), <span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/Text&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,</span></td>
      </tr>
      <tr>
        <td id="L231" class="blob-num js-line-number" data-line-number="231"></td>
        <td id="LC231" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">			<span class="pl-s"><span class="pl-pds">&#39;</span>&lt;/TiptelIPPhoneTextScreen&gt;<span class="pl-pds">&#39;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L232" class="blob-num js-line-number" data-line-number="232"></td>
        <td id="LC232" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	}</span></td>
      </tr>
      <tr>
        <td id="L233" class="blob-num js-line-number" data-line-number="233"></td>
        <td id="LC233" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">	</span></td>
      </tr>
      <tr>
        <td id="L234" class="blob-num js-line-number" data-line-number="234"></td>
        <td id="LC234" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
      <tr>
        <td id="L235" class="blob-num js-line-number" data-line-number="235"></td>
        <td id="LC235" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">#################################### DIAL LOG }</span></span></td>
      </tr>
      <tr>
        <td id="L236" class="blob-num js-line-number" data-line-number="236"></td>
        <td id="LC236" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L237" class="blob-num js-line-number" data-line-number="237"></td>
        <td id="LC237" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L238" class="blob-num js-line-number" data-line-number="238"></td>
        <td id="LC238" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">_ob_send();</span></td>
      </tr>
      <tr>
        <td id="L239" class="blob-num js-line-number" data-line-number="239"></td>
        <td id="LC239" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L240" class="blob-num js-line-number" data-line-number="240"></td>
        <td id="LC240" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span><span class="pl-pse"><span class="pl-s1">?</span>&gt;</span></td>
      </tr>
</table>

  </div>

</div>

<a href="#jump-to-line" rel="facebox[.linejump]" data-hotkey="l" style="display:none">Jump to Line</a>
<div id="jump-to-line" style="display:none">
  <form accept-charset="UTF-8" action="" class="js-jump-to-line-form" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
    <input class="linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" autofocus>
    <button type="submit" class="btn">Go</button>
</form></div>

        </div>

      </div><!-- /.repo-container -->
      <div class="modal-backdrop"></div>
    </div><!-- /.container -->
  </div><!-- /.site -->


    </div><!-- /.wrapper -->

      <div class="container">
  <div class="site-footer" role="contentinfo">
    <ul class="site-footer-links right">
        <li><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
      <li><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li><a href="https://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
      <li><a href="https://shop.github.com" data-ga-click="Footer, go to shop, text:shop">Shop</a></li>
        <li><a href="https://github.com/blog" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a href="https://github.com/about" data-ga-click="Footer, go to about, text:about">About</a></li>
        <li><a href="https://help.github.com" data-ga-click="Footer, go to help, text:help">Help</a></li>

    </ul>

    <a href="https://github.com" aria-label="Homepage">
      <span class="mega-octicon octicon-mark-github" title="GitHub"></span>
</a>
    <ul class="site-footer-links">
      <li>&copy; 2015 <span title="0.12048s from github-fe129-cp1-prd.iad.github.net">GitHub</span>, Inc.</li>
        <li><a href="https://github.com/site/terms" data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
        <li><a href="https://github.com/site/privacy" data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
        <li><a href="https://github.com/security" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li><a href="https://github.com/contact" data-ga-click="Footer, go to contact, text:contact">Contact</a></li>
    </ul>
  </div>
</div>


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-suggester-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="fullscreen-contents js-fullscreen-contents" placeholder=""></textarea>
      <div class="suggester-container">
        <div class="suggester fullscreen-suggester js-suggester js-navigation-container"></div>
      </div>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped tooltipped-w" aria-label="Exit Zen Mode">
      <span class="mega-octicon octicon-screen-normal"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped tooltipped-w"
      aria-label="Switch themes">
      <span class="octicon octicon-color-mode"></span>
    </a>
  </div>
</div>



    
    

    <div id="ajax-error-message" class="flash flash-error">
      <span class="octicon octicon-alert"></span>
      <a href="#" class="octicon octicon-x flash-close js-ajax-error-dismiss" aria-label="Dismiss error"></a>
      Something went wrong with that request. Please try again.
    </div>


      <script crossorigin="anonymous" src="https://assets-cdn.github.com/assets/frameworks-3241a40a58a82e21daef3dd3cdca01bde189158793c1b6f9193fff2b5293cd1d.js"></script>
      <script async="async" crossorigin="anonymous" src="https://assets-cdn.github.com/assets/github/index-93799dc3b48721586da77cc7c73632bc4fb8e157356876ec160370ab6be81349.js"></script>
      
      
  </body>
</html>

