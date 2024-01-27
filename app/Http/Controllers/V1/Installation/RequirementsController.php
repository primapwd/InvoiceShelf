<?php

namespace InvoiceShelf\Http\Controllers\V1\Installation;

use InvoiceShelf\Http\Controllers\Controller;
use InvoiceShelf\Space\RequirementsChecker;
use Illuminate\Http\JsonResponse;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return JsonResponse
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPVersion(
            config('installer.core.minPhpVersion')
        );

        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return response()->json([
            'phpSupportInfo' => $phpSupportInfo,
            'requirements' => $requirements,
        ]);
    }
}
