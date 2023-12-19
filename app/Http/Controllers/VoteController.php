<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\VoteOption;
use App\Models\VoteData;
use App\Models\VotePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class VoteController extends Controller {
    public function index() {
        $voteData = Vote::orderBy('created_at', 'DESC')->get();
        return response()->json($voteData);
    }
    public function create(Request $request) {
        $request->validate([
            'owner_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'only_verified' => 'required',
            'use_password' => 'required',
        ]);

        $vote = new Vote;
        $vote->owner_id = $request->input('owner_id');
        $vote->title = $request->input('title');
        $vote->slug = $request->input('slug');
        $vote->date = $request->input('end_date');
        $vote->time = $request->input('end_time');
        $vote->description = $request->input('description');
        $vote->is_verified = $request->only_verified;
        $vote->is_password = $request->use_password;
        $vote->save();
        return response()->json($vote);
    }

    public function insert(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'vote_id' => 'required',
            'slug' => 'required',
            'option_id' => 'required',
            'is_verified' => 'required',
        ]);

        $vote = new VoteData;
        $vote->user_id = $request->user_id;
        $vote->vote_id = $request->vote_id;
        $vote->vote_slug = $request->slug;
        $vote->vote_option = $request->option_id;
        $vote->is_verified = $request->is_verified;
        $vote->save();

        $voteOption = VoteOption::where('id', $request->option_id)->first();
        $updater = (int) $voteOption->total_vote + 1;

        $updateVote = VoteOption::findOrFail($request->option_id);
        $updateVote->update([
            'total_vote' => $updater
        ]);

        return response()->json($vote);
    }

    public function updateOption($id) {
        $voteOption = VoteOption::where('id', $id)->first();
        $updater = (int) $voteOption->total_vote + 1;

        $updateVote = VoteOption::findOrFail($id);
        $updateVote->update([
            'total_vote' => $updater
        ]);
        return response()->json($updateVote);
    }

    public function insertPassword(Request $request) {
        $request->validate([
            'slug' => 'required',
            'password' => 'required',
        ]);

        $vote = new VotePassword;
        $vote->vote_slug = $request->slug;
        $vote->password = $request->password;
        $vote->save();

        return response()->json($vote);
    }

    public function options(Request $request) {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required',
            'slug' => 'required',
        ]);
        $file_name = time().'_'.$request->file->getClientOriginalName();
        $file_path = $request->file('file')->move(public_path('assets/img/options'), $file_name);

        $voteOption = new VoteOption;
        $voteOption->vote_slug = $request->slug;
        $voteOption->image = '/assets/img/options/'.$file_name;
        $voteOption->name = $request->name;
        $voteOption->save();
        return response()->json($voteOption);
    }

    public function delete(Request $request) {
        $request->validate([
            'slug' => 'required',
        ]);
        $votes = DB::table('votes')
            ->where('slug', $request->slug)->delete();
        $voteData = DB::table('vote_data')
            ->where('vote_slug', $request->slug)->delete();
        $voteOption = DB::table('vote_options')
            ->where('vote_slug', $request->slug)->delete();
        $votePassword = DB::table('vote_passwords')
            ->where('vote_slug', $request->slug)->delete();
        return response()->json(['message' => 'Data has been deleted.']);
    }

    public function showData($slug) {
        $voteData = Vote::where('slug', $slug)->first();
        return response()->json($voteData);
    }

    public function checkPassword($slug) {
        $voteData = Vote::where('slug', $slug)->select('is_password')->first();
        return response()->json($voteData);
    }

    public function showPasswords($slug) {
        $votePasswords = VotePassword::where('vote_slug', $slug)->select('password')->first();
        return response()->json($votePasswords);
    }

    public function checkUser($user, $slug) {
        $userExists = VoteData::where([
            ['vote_slug', '=', $slug],
            ['user_id', '=', $user]
        ])->exists();
        return response()->json($userExists);
    }

    public function getData($id) {
        $voteData = Vote::orderBy('created_at', 'DESC')->where('owner_id', $id)->get();
        return response()->json($voteData);
    }

    public function showOptions($slug) {
        $voteOption = VoteOption::where('vote_slug', $slug)->get();
        return response()->json($voteOption);
    }
}

