<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\Setting;
use App\Models\Branch;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        config('APP_NAME','My Application');

        $branch = null;
        if($request->user()){
            if($request->user()->branch_id != null && $request->user()->branch_id != '') {
                $branch = Branch::find($request->user()->branch_id);
            }
        }

        $branches = Branch::count() > 0 ? Branch::get() : null;
        

        return array_merge(parent::share($request), [
            'gbranches' => $branches,
            'gbranch' => $branch,
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'settings' => [
                "schoolName" => $this->setting("School Name"),
                "tagLine" => $this->setting("Tag Line"),
                "logo" => $this->setting("Logo"),
                "favicom" => $this->setting("Favicon"),
            ],
            'csrf_token' => csrf_token(),
        ]);
    }

    protected function setting($prop){
        return $setting = Setting::where('key', $prop)->exists() ? Setting::where('key', $prop)->first()->val : null;
    }
}
