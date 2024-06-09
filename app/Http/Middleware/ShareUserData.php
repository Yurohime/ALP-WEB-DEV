namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Pelanggan;

class ShareUserData
{
    public function handle($request, Closure $next)
    {
        $userId = Session::get('id_pelanggan');
        $user = null;

        if ($userId) {
            $user = Pelanggan::find($userId);
        }

        // Log the user data for debugging
        Log::info('User shared to views:', ['user' => $user]);

        view()->share('loggedInUser', $user);

        return $next($request);
    }
}
