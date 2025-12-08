<?php

namespace model\manager;

use model\ManagerInterface;
use model\mapping\LikesMapping;
use model\mapping\UserMapping;
use model\mapping\RecipesMapping;
use PDO;
use Exception;

class LikesManager implements ManagerInterface
{
    private PDO $connect;

    public function __construct(PDO $connect)
    {
        $this->connect = $connect;
    }

    public function getAllLikes(): array
    {
        $sql = "SELECT l.*, u.user_name, r.recipe_title FROM `likes` l
                INNER JOIN `users` u ON l.`users_users_id` = u.`users_id`
                INNER JOIN `recipes` r ON l.`recipes_recipes_id` = r.`recipes_id`
                ORDER BY l.`likes_id` DESC";

        try {
            $query = $this->connect->query($sql);
            $likesData = $query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();

            $listLike = [];
            foreach ($likesData as $data) {
                $user = new UserMapping($data);
                $recipe = new RecipesMapping($data);
                $likes = new LikesMapping($data);
                $likes->setUser($user);
                $likes->setRecipe($recipe);

                $listLike[] = $likes;
            }

            return $listLike;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des likes : " . $e->getMessage();
            return [];
        }
    }

    public function getLikeById(int $id): ?LikesMapping
    {
        $sql = "SELECT l.*, u.user_name, r.recipe_title FROM `likes` l
                INNER JOIN `users` u ON l.`users_users_id` = u.`users_id`
                INNER JOIN `recipes` r ON l.`recipes_recipes_id` = r.`recipes_id`
                WHERE l.likes_id = :id";
        
        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $prepare->execute();
            $likeData = $prepare->fetch(PDO::FETCH_ASSOC);
            $prepare->closeCursor();

            if ($likeData) {
                $user = new UserMapping($likeData);
                $recipe = new RecipesMapping($likeData);
                $like = new LikesMapping($likeData);
                $like->setUser($user);
                $like->setRecipe($recipe);
                return $like;
            }
            return null;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération du like : " . $e->getMessage();
            return null;
        }
    }

    public function getLikesByRecipeId(int $recipeId): array
    {
        $sql = "SELECT l.*, u.user_name FROM `likes` l
                INNER JOIN `users` u ON l.`users_users_id` = u.`users_id`
                WHERE l.recipes_recipes_id = :recipeId
                ORDER BY l.`likes_id` DESC";

        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
        
        try {
            $prepare->execute();
            $likesData = $prepare->fetchAll(PDO::FETCH_ASSOC);
            $prepare->closeCursor();

            $listLike = [];
            foreach ($likesData as $data) {
                $user = new UserMapping($data);
                $likes = new LikesMapping($data);
                $likes->setUser($user);

                $listLike[] = $likes;
            }

            return $listLike;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des likes : " . $e->getMessage();
            return [];
        }
    }

    public function getAverageRatingByRecipeId(int $recipeId): array
    {
        $sql = "SELECT AVG(`like_cote`) as average, COUNT(`likes_id`) as count FROM `likes` WHERE `recipes_recipes_id` = :recipeId";
        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
        
        try {
            $prepare->execute();
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            $prepare->closeCursor();

            return $result;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération de la moyenne des likes : " . $e->getMessage();
            return ['average' => 0, 'count' => 0];
        }
    }

    public function findOneByUserAndRecipe(int $userId, int $recipeId): ?LikesMapping
    {
        $sql = "SELECT * FROM `likes` WHERE `users_users_id` = :userId AND `recipes_recipes_id` = :recipeId";
        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':userId', $userId, PDO::PARAM_INT);
        $prepare->bindValue(':recipeId', $recipeId, PDO::PARAM_INT);
        
        try {
            $prepare->execute();
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            $prepare->closeCursor();

            return $result ? new LikesMapping($result) : null;
        } catch (Exception $e) {
            echo "Erreur lors de la recherche du like : " . $e->getMessage();
            return null;
        }
    }

    public function updateLike(LikesMapping $like): bool
    {
        $sql = "UPDATE `likes` SET `like_cote` = :cote WHERE `likes_id` = :likeId";
        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':cote', $like->getLikeCote(), PDO::PARAM_INT);
        $prepare->bindValue(':likeId', $like->getLikesId(), PDO::PARAM_INT);

        try {
            return $prepare->execute();
        } catch (Exception $e) {
            echo "Erreur lors de la mise à jour du like : " . $e->getMessage();
            return false;
        }
    }

    public function addLike(LikesMapping $like): bool
    {
        $sql = "INSERT INTO `likes` (`users_users_id`, `recipes_recipes_id`, `like_cote`) VALUES (:userId, :recipeId, :cote)";
        $prepare = $this->connect->prepare($sql);
        $prepare->bindValue(':userId', $like->getUsersUsersId(), PDO::PARAM_INT);
        $prepare->bindValue(':recipeId', $like->getRecipesRecipesId(), PDO::PARAM_INT);
        $prepare->bindValue(':cote', $like->getLikeCote(), PDO::PARAM_INT);

        try {
            return $prepare->execute();
        } catch (Exception $e) {
            echo "Erreur lors de l'ajout du like : " . $e->getMessage();
            return false;
        }
    }
}
