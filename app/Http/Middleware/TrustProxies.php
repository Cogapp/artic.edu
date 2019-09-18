<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Closure;
use Cache;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = [];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;

    /**
     * Add remote address to trusted proxy list
     */
    public function handle(Request $request, Closure $next)
    {
        $ips = Cache::remember('list-cloudfront-ips', 60, function () {
            return file_get_contents('http://d7uri8nf7uskq.cloudfront.net/tools/list-cloudfront-ips');
        });

        $ips = json_decode($ips);

        $this->proxies = array_merge(
            $this->proxies,
            $ips->{"CLOUDFRONT_GLOBAL_IP_LIST"},
            $ips->{"CLOUDFRONT_REGIONAL_EDGE_IP_LIST"}
        );

        array_push($this->proxies, $request->server->get('REMOTE_ADDR'));
        parent::handle($request, $next);
        return $next($request);
    }
}
