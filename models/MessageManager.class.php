<?php
class MessageManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM message WHERE id='".$id."'";
		$res = $this->db->query($query, PDO::FETCH_CLASS, "Message", [$this->db]);
		if ($res)
		{
			$message = $res->fetch();
			return $message;
		}
		else
			throw new Exception("Internal Server Error > ".mysqli_error($this->db));
	}
	public function create(User $author, $content)
	{
		$message = new Message($this->db);
		$message->setAuthor($author);
		$message->setContent($content);
		$id_author = intval($message->getAuthor()->getId());
		$content = $this->db->quote($message->getContent());
		$query = "INSERT INTO message (id_author, content) VALUES('".$id_author."', '".$content."')";
		$res = $this->db->exec($query);
		if ($res)
			return $this->findById($this->db->lastInsertId());
		else
			throw new Exception("Internal Server Error > ".mysqli_error($this->db));
	}
	public function findAll()
	{
		$query = "SELECT * FROM message ORDER BY date";
		$res = $this->db->query($query, PDO::FETCH_CLASS, "Message", [$this->db]);
		if ($res)
		{
			$messages = $res->fetchAll();
			return $messages;
		}
		else
			throw new Exception("Internal Server Error > ".mysqli_error($this->db));
	}
	public function findNext($id = 0)
	{
		$id = intval($id);
		$query = "SELECT * FROM message WHERE id>'".$id."'ORDER BY date";
		$res = $this->db->query($query, PDO::FETCH_CLASS, "Message", [$this->db]);
		if ($res)
		{
			$messages = $res->fetchAll();
			return $messages;
		}
		else
			throw new Exception("Internal Server Error > ".mysqli_error($this->db));
	}
}
?>