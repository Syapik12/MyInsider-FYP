import java.util.ArrayList;
import java.util.Arrays;

public class NumberPairs {

    public static void main(String[] args) {
        int[] inputArray = {12, 23, 45, 56, 78, 89, 91, 10};

        // Find pairs and store them in a new array
        ArrayList<Integer> resultArray = new ArrayList<>();
        for (int i = 0; i < inputArray.length - 1; i++) {
            int firstNumber = inputArray[i];
            int secondNumber = inputArray[i + 1];

            if (getLastDigit(firstNumber) == getFirstDigit(secondNumber)) {
                resultArray.add(firstNumber);
                resultArray.add(secondNumber);
                i++; // Skip the next number since it's already part of a pair
            } else {
                resultArray.add(firstNumber);
            }
        }

        // If the last number doesn't have a pair, add it to the result array
        if (resultArray.size() % 2 != 0) {
            resultArray.add(inputArray[inputArray.length - 1]);
        }

        // Display the result array
        System.out.println("Resulting Array: " + Arrays.toString(resultArray.toArray()));
    }

    private static int getLastDigit(int number) {
        return number % 10;
    }

    private static int getFirstDigit(int number) {
        while (number >= 10) {
            number /= 10;
        }
        return number;
    }
}
