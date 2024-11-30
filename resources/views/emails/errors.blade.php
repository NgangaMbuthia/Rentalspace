


<h3>Error Log Informtion from rental.com</h3>
<strong>Time of Error</strong> {{ date('M d, Y H:iA') }}<br>


<strong>Message:</strong> {{ $e->getMessage() }}<p>

<strong>Code:</strong> {{ $e->getCode() }}<p>

<strong>File:</strong> {{ $e->getFile() }}<p>

<strong>Line:</strong> {{ $e->getLine() }}<p>

<strong>Affected User:</strong> {{ @Auth::user()->name }}   -{{ @Auth::user()->profile->telephone}}<p>