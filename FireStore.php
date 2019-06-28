<?php

require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

class FireStore
{
    protected $db;
    protected $name;

    public function __construct(string $collection)
    {
        $this->db = new FirestoreClient([
            'projectId' => 'convert-forum'
        ]);

        $this->name = $collection;
    }

    public function getDocument(string $name)
    {
        return $this->db->collection($this->name)->document($name)->snapshot()->data();
    }

    public function getWhere(string $field, string $operator, $value)
    {
        $array = [];

        $query = $this->db->collection($this->name)->where($field, $operator, $value)->documents()->rows();

        foreach ($query as $item) {
            $array[] = $item->data();
        }
        return $array;
    }

    public function newDocument(string $name, array $data = [])
    {
        $this->db->collection($this->name)->document($name)->create($data);

        return true;
    }

    public function newCollection(string $name, string $doc_name, array $data = [])
    {
        $this->db->collection($name)->document($doc_name)->create($data);

        return true;
    }

    public function dropDocument(string $name)
    {
        $this->db->collection($this->name)->document($name)->delete();
    }

// the commented bit is a never ending loop, and the none commented bit does that delete the
    public function dropCollection(string $name)
    {
        $documents = $this->db->collection($name)->limit(1)->documents();

        $documents->reference()->delete();
        // $documents = $this->db->collection($name)->limit(1)->documents();
        //
        // while ($documents->!isEmpty()) {
        //     foreach($documents as $item) {
        //         $item->reference()->delete();
        //     }
        // }
    }
}
