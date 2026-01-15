<?php

function getAllTasksSorted($pdo, $sort = 'created_at', $dir = 'desc')
{
    try {
        $sql = "
            SELECT 
                t.*,
                u.first_name AS assigned_first_name,
                u.last_name  AS assigned_last_name,
                u.role       AS assigned_role
            FROM tasks t
            JOIN users u ON u.id = t.assigned_to
            WHERE 1=1
        ";

        $allowedSorts = [
            'created_at' => 't.created_at',
            'modified_at' => 't.modified_at',
            'status' => 't.status',
            'employee' => 'u.last_name'
        ];

        $sort = strtolower(trim($sort));
        $dir = strtolower(trim($dir));

        if (!isset($allowedSorts[$sort])) {
            $sort = 'created_at';
        }

        if ($dir !== 'asc' && $dir !== 'desc') {
            $dir = 'desc';
        }

        $sql .= ' ORDER BY ' . $allowedSorts[$sort] . ' ' . $dir;

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();

    } catch (PDOException $e) {
        die('Erreur getAllTasksSorted : ' . $e->getMessage());
    }
}





