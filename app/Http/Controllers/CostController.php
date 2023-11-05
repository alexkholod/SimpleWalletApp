<?php
//
//Здесь надо почти всё переписать нахер, так как нахуеверчено одно на другое..
//
namespace App\Http\Controllers;

use App\Http\Requests\AddCostRequest;
use App\Models\Category;
use App\Models\Cost;
use App\Models\Wallet;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CostController extends Controller
{
    public function add(AddCostRequest $request): RedirectResponse
    {
        $cost = new Cost();
        $cost->user_id = $request->user()->id;
        $cost->wallet_id = $request->input('wallets');
        $cost->category_id = $request->input('categories');
        $cost->value = $request->input('value');
        $cost->created_at = $request->input('date');
        $cost->comment = $request->input('comment') ?? '';

        $cost->save();

        return redirect()->route('costs');
    }

    public function makeAddView(): Renderable
    {
        $wallets = Wallet::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('addCost')
            ->with(compact('wallets', 'categories' ));
    }

    public function viewSingleCost($id, int $year, int $month): Renderable
    {
        $cost = Cost::find($id);
        $wallets = Wallet::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('update-cost')
            ->with([
                'wallets'    => $wallets,
                'categories' => $categories,
                'cost'       => $cost,
                'year'       => $year,
                'month'      => $month
            ]);
    }

    public function update($id, AddCostRequest $request): Renderable
    {
        $cost = Cost::find($id);
        $cost->user_id = $request->user()->id;
        $cost->wallet_id = $request->input('wallets');
        $cost->category_id = $request->input('categories');
        $cost->value = $request->input('value');
        $cost->created_at = $request->input('date');
        $cost->comment = $request->input('comment');

        $month = $request->month;
        $year = $request->year;

        $cost->save();

        return $this->makeAllCostsView($request)->with([
            'selectedYear' => $year,
            'selectedMonth' => $month,
            'success' => 'Сохранено успешно']);
    }

    public function delete($id): RedirectResponse
    {
        $cost = Cost::find($id);
        $cost->category()->dissociate();
        $cost->wallet()->dissociate();
        $cost->delete();

        return redirect()->route('costs');
    }

    public function makeAllCostsView(Request $request): Renderable
    {
        $year = [
            2021 => '2021',
            2022 => '2022',
            2023 => '2023',
            2024 => '2024'
        ];

        $month = [
            1  => 'Январь',
            2  => 'Февраль',
            3  => 'Март',
            4  => 'Апрель',
            5  => 'Май',
            6  => 'Июнь',
            7  => 'Июль',
            8  => 'Август',
            9  => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
        ];

        $selectedYear = $request->year ?? Carbon::now()->year;
        $selectedMonth = $request->month ?? Carbon::now()->month;

        $allCostsPerMonth = $this->costsPerMonth($selectedYear, $selectedMonth, $request);

        $costsPerMonthApteka = $this->costsPerMonth($selectedYear, $selectedMonth, $request)
        ->where('category_id', '=', 5)
            ->sum('value');

        $costsPerMonthDoctors = $this->costsPerMonth($selectedYear, $selectedMonth, $request)
            ->where('category_id', '=', 7)
            ->sum('value');

        $costsPerMonthMom = $this->costsPerMonth($selectedYear, $selectedMonth, $request)
            ->where('category_id', '=', 16)
            ->sum('value');

        $sum = $allCostsPerMonth->sum('value');

        $costsByCategoryVisa = $this->costsByCategoryVisa($selectedYear, $selectedMonth, $request);

        $costsByCategoryCash = $this->costsByCategoryCash($selectedYear, $selectedMonth, $request);

        $costsByWallet = $this->costsByWallet($selectedYear, $selectedMonth, $request);

        return view('costs')->with([
            'data' => $allCostsPerMonth,
            'sum' => $sum,
            'year' => $year,
            'month' => $month,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
            'costsByCategoryVisa' => $costsByCategoryVisa,
            'costsByCategoryCash' => $costsByCategoryCash,
            'costsByWallet' => $costsByWallet,
            'costsPerMonthDoctors' => $costsPerMonthDoctors,
            'costsPerMonthApteka' => $costsPerMonthApteka,
            'costsPerMonthMom' => $costsPerMonthMom
        ]);
    }

    public function costsPerMonth(int $year, int $month, Request $request): Collection
    {
        $costsPerMonth = Cost::all()
            ->where('user_id', '=', $request->user()->id)
            ->whereBetween('created_at', [
            Carbon::create($year, $month)->startOfMonth(),
            Carbon::create($year, $month)->endOfMonth()

        ])->sortByDesc('created_at');

        return $costsPerMonth;
    }

    public function costsByCategoryVisa(int $year, int $month, Request $request): array
    {
        $categories = Category::all();

        $costsByCategoryVisa = [];

        foreach ($categories as $category) {
            $costsByCategoryVisa[$category->name] = Cost::where('user_id', '=', $request->user()->id)
            ->where('category_id', '=', $category->id)
                ->where('wallet_id', '=', 1)
                ->whereBetween('created_at', [
                    Carbon::create($year, $month)->startOfMonth(),
                    Carbon::create($year, $month)->endOfMonth()
                ])->sum('value');
        }
        arsort($costsByCategoryVisa);

        return $costsByCategoryVisa;
    }

    public function costsByCategoryCash(int $year, int $month, Request $request): array
    {
        $categories = Category::all();

        $costsByCategoryCash = [];

        foreach ($categories as $category) {
            $costsByCategoryCash[$category->name] = Cost::where('user_id', '=', $request->user()->id)
                ->where('category_id', '=', $category->id)
                ->where('wallet_id', '=', 2)
                ->whereBetween('created_at', [
                    Carbon::create($year, $month)->startOfMonth(),
                    Carbon::create($year, $month)->endOfMonth()
                ])->sum('value');
        }
        arsort($costsByCategoryCash);

        return $costsByCategoryCash;
    }

    public function costsByWallet(int $year, int $month, Request $request): array
    {
        $wallets = Wallet::all();

        $costsByWallet =[];

        foreach ($wallets as $wallet) {
            $costsByWallet[$wallet->name] = Cost::where('user_id', '=', $request->user()->id)
                ->where('wallet_id', '=', $wallet->id)
                ->whereBetween('created_at', [
                    Carbon::create($year, $month)->startOfMonth(),
                    Carbon::create($year, $month)->endOfMonth()
                ])->sum('value');
        }
        arsort($costsByWallet);

        return $costsByWallet;
    }

    public function makeMainView(Request $request): Renderable
    {
        $costPerWeek = Cost::where('user_id', '=', $request->user()->id)
        ->whereBetween('created_at', [
            Carbon::parse('last monday'),
            Carbon::now()->endOfWeek()
        ])->sum('value');

        $weekByCard = Cost::where('user_id', '=', $request->user()->id)
            ->where('wallet_id', '=', 1)
            ->whereBetween('created_at', [
                Carbon::parse('last monday'),
                Carbon::now()->endOfWeek()
            ])->sum('value');

        $weekByCash = Cost::where('user_id', '=', $request->user()->id)
            ->where('wallet_id', '=', 2)
            ->whereBetween('created_at', [
                Carbon::parse('last monday'),
                Carbon::now()->endOfWeek()
            ])->sum('value');

        $costPerMonth = Cost::where('user_id', '=', $request->user()->id)
        ->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('value');

        $monthByCard = Cost::where('user_id', '=', $request->user()->id)
            ->where('wallet_id', '=', 1)
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->sum('value');

        $monthByCash = Cost::where('user_id', '=', $request->user()->id)
            ->where('wallet_id', '=', 2)
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->sum('value');

        $categories = Category::all();

        $costsByCategory = [];

        foreach ($categories as $category) {
            $costsByCategory[$category->name] = Cost::where('user_id', '=', $request->user()->id)
            ->where('category_id', '=', $category->id)
            ->whereBetween('created_at', [
                      Carbon::now()->startOfMonth(),
                      Carbon::now()->endOfMonth()
                 ])->sum('value');
        }

        arsort($costsByCategory);
        $costsByCategory = array_slice($costsByCategory, 0, 5, true);

        return view('index', [
            'week'  => $costPerWeek,
            'weekByCard' => $weekByCard,
            'weekByCash' => $weekByCash,
            'month' => $costPerMonth,
            'monthByCard' => $monthByCard,
            'monthByCash' => $monthByCash,
            'costsByCategory' => $costsByCategory
        ]);
    }
}
