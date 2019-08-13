<?php
/* przestrzeń nazw Controllers */
namespace App\Http\Controllers;

/* import klas */
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/* stworzenie klasy naszego kontrolera SubjectController */
class SubjectController extends Controller
{
    /* funkcja początkowa zwracająca nasz widok przedmiotów */
    public function index()
    {
        $subjects = Subject::get();

        return view('subject.index')->with(compact('subjects'));
    }

    /* funkcja sprawdzająca czy przedmiot istnieje już w bazie danych, sprawdzenie odbywa się poprzez przeszukanie nazw przedmiotu */
    public function checkIfSubjectExist($name = null)
    {
        if (Subject::where('subject_name', '=', $name)->exists())
            return true;
        else
            return false;
    }

    /* funkcja tworząca przedmiot w bazie danych,
    pierw sprawdzamy czy przedmiot o podanej nazwie już istnieje,
    następnie tworzona jest nowa instancja klasy Subject z pliku ./app/Subject.php,
    nadana jest nazwa przedmiotu,
    zapis do bazy przez funkcje save() oraz zwrotna informacja czy się powiodło,
    na samym końcu zwracany jest nowy widok subject.create */
    public function create(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            if ($this->checkIfSubjectExist($data['subject_name'])) {

                return redirect('przedmioty/dodaj')->with('flash_message_error','Przedmiot '.$data['subject_name'].' juz istnieje');
            }

            $subject = new Subject;
            $subject->subject_name = $data['subject_name'];

            if ($subject->save())
                return redirect('przedmioty')->with('flash_message_success','Przedmiot został dodany.');
            else
                return redirect('przedmioty')->with('flash_message_error','Błąd podczas dodawania przedmiotu.');
        }
        return view('subject.create');
    }

    /* funkcja edytująca przedmiot w bazie danych,
    pobranie przedmiotu o zadanym ID,
    sprawdzenie czy nowa podana nazwa zawiera się już w bazie danych,
    jeżeli nie zawiera się to nadajemy nową nazwę,
    jeżeli aktualizacja powiodła się to zwracamy komunikat o sukcesie, jeżeli nie to o błędzie.
    wyświetlenie nowego widoku subject.edit
    */
    public function edit(Request $request, $subject_id = null)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->input();

            $subject = Subject::where('subject_id',$subject_id)->first();

            if ($subject->subject_name != $data['subject_name'])
                if ($this->checkIfSubjectExist($data['subject_name'])) {

                    return redirect('przedmioty/edytuj/'.$subject_id)->with('flash_message_error','Przedmiot '.$data['subject_name'].' juz istnieje');
                }

            $subject_data['subject_name'] = $data['subject_name'];

            if (Subject::where('subject_id',$subject_id)->update($subject_data))
                return redirect('przedmioty')->with('flash_message_success','Przedmiot został zaktualizowany.');
            else
                return redirect('przedmioty')->with('flash_message_error','Błąd podczas aktualizowania przedmiotu.');
        }

        $subject = Subject::where('subject_id',$subject_id)->first();

        return view('subject.edit')->with(compact('subject'));
    }

    /* funkcja kasująca przedmiot w bazie danych,
    pobranie przedmiotu o zadanym ID,
    wywołanie funkcji delete() w celu usunięcia,
    jeżeli usunięcie powiodło się to zwracamy komunikat o sukcesie, jeżeli nie to o błędzie.
    wyświetlenie zakładki przedmioty
    */
    public function delete(Request $request, $subject_id = null)
    {
        if(!empty($subject_id))
        {
            if (Subject::where('subject_id',$subject_id)->delete())
                 return redirect('przedmioty')->with('flash_message_success','Przedmiot został usunięty.');
            else
                return redirect('przedmioty')->with('flash_message_error','Błąd podczas usuwania przedmiotu.');
        }
        return redirect('przedmioty');
    }
}
